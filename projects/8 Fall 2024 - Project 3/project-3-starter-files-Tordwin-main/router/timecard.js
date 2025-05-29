const express = require('express');

module.exports = function(dl) {
    const router = express.Router();

    router.get('/timecard', async function (req, res) {
        const { companyName, timecard_id } = req.query;
        if (!companyName) {
            return res.status(400).json({ "error": "Missing companyName query parameter." });
        }
        if (companyName != "ec7233") {
            return res.status(400).json({ "error": "Invalid RIT companyName." });
        }
        if (!timecard_id) {
            return res.status(400).json({ "error": "Missing timecard_id query parameter." });
        }

        try {
            const timecard = await dl.getTimecard(timecard_id);
            if (timecard) {
                return res.json(timecard);
            } else {
                return res.status(404).json({ "error": `Timecard ${timecard_id} not found` });
            }
        } catch (err) {
            return res.status(500).json({ "error": err.message });
        }

    });

    router.get('/timecards', async function (req, res) {
        const { companyName, emp_id } = req.query;
        if (!companyName) {
            return res.status(400).json({ "error": "Missing companyName query parameter." });
        }
        if (companyName != "ec7233") {
            return res.status(400).json({ "error": "Invalid RIT companyName." });
        }
        if (!emp_id) {
            return res.status(400).json({ "error": "Missing emp_id query parameter." });
        }

        try {
            const timecards = await dl.getAllTimecard(emp_id);
            if (timecards && timecards.length > 0) {
                return res.json(timecards);
            } else {
                return res.status(404).json({ "error": `No timecards found for emp_id: ${emp_id}.` });
            }
        } catch (err) {
            return res.status(500).json({ "error": err.message });
        }
    });

    router.post('/timecard', async function (req, res) {
        const { companyName, start_time, end_time, emp_id } = req.body;
        if (!companyName || !start_time || !end_time || !emp_id) {
            return res.status(400).json({ "error": "Missing required fields." });
        }

        try {
            if (companyName != "ec7233") {
                return res.status(400).json({ "error": "Invalid RIT companyName." });
            }
            const employee = await dl.getEmployee(emp_id);
            if (!employee) {
                return res.status(400).json({ "error": `Employee ${emp_id} not found.` });
            }
            const startTime = new Date(start_time);
            const endTime = new Date(end_time);
            const currentTime = new Date();
            if (isNaN(startTime) || isNaN(endTime)) {
                return res.status(400).json({ "error": "Invalid start_time or end_time format." });
            }
            const currDay = currentTime.getDay();
            const monday = new Date(currentTime);
            const removeDays = currDay === 0 ? 6 : currDay - 1;
            monday.setDate(currentTime.getDate() - removeDays);
            monday.setHours(0, 0, 0, 0);
            const startDay = startTime.getDay();
            if (startDay === 0 || startDay === 6) {
                return res.status(400).json({ "error": "Timecard must be on a weekday." });
            }
            if (startTime.toDateString() !== currentTime.toDateString() && (startTime < monday || startTime > currentTime)) {
                return res.status(400).json({ "error": `start_time ${start_time} is not today or within this week's Monday to today.` });
            }
            if (startTime.toDateString() !== endTime.toDateString()) {
                return res.status(400).json({ "error": "end_time must be on the same day as start_time." });
            }
            const hours = (endTime - startTime) / (1000 * 60 * 60);
            if (hours < 1) {
                return res.status(400).json({ "error": "Timecard must be at least 1 hour." });
            }
            const startTimeHours = startTime.getHours() * 60 + startTime.getMinutes();
            const endTimeHours = endTime.getHours() * 60 + endTime.getMinutes();
            const clockInEarliest = 480;
            const clockOutLatest = 1080;
            if (startTimeHours < clockInEarliest || endTimeHours > clockOutLatest) {
                return res.status(400).json({ "error": "Timecard must be between 8:00 AM and 6:00 PM." });
            }
            const timecards = await dl.getAllTimecard(emp_id);
            for (const timecard in timecards) {
                const card = timecards[timecard];
                const cardStartTime = new Date(card.start_time);
                if (cardStartTime.toDateString() === startTime.toDateString()) {
                    return res.status(400).json({ "error": `Timecard already exists for emp_id ${emp_id} on ${start_time}.` });
                }
            }

            const newTimecard = new dl.Timecard(start_time, end_time, emp_id);
            dl.insertTimecard(newTimecard);
            return res.status(201).json({ "response": `Timecard added successfully for emp_id ${emp_id}.` });
        } catch (err) {
            return res.status(500).json({ "error": err.message });
        }
    });

    router.put('/timecard', async function (req, res) {
        const { companyName, timecard_id, start_time, end_time, emp_id } = req.body;
        if (!companyName || !timecard_id || !start_time || !end_time || !emp_id) {
            return res.status(400).json({ "error": "Missing required fields." });
        }

        try {
            if (companyName != "ec7233") {
                return res.status(400).json({ "error": "Invalid RIT companyName." });
            }
            const employee = await dl.getEmployee(emp_id);
            if (!employee) {
                return res.status(400).json({ "error": `Employee ${emp_id} not found.` });
            } // check this
            const startTime = new Date(start_time);
            const endTime = new Date(end_time);
            const currentTime = new Date();
            if (isNaN(startTime) || isNaN(endTime)) {
                return res.status(400).json({ "error": "Invalid start_time or end_time format." });
            }
            const currDay = currentTime.getDay();
            const monday = new Date(currentTime);
            const removeDays = currDay === 0 ? 6 : currDay - 1;
            monday.setDate(currentTime.getDate() - removeDays);
            monday.setHours(0, 0, 0, 0);
            const startDay = startTime.getDay();
            if (startDay === 0 || startDay === 6) {
                return res.status(400).json({ "error": "Timecard must be on a weekday." });
            }
            if (startTime.toDateString() !== currentTime.toDateString() && (startTime < monday || startTime > currentTime)) {
                return res.status(400).json({ "error": `start_time ${start_time} is not today or within this week's Monday to today.` });
            }
            if (startTime.toDateString() !== endTime.toDateString()) {
                return res.status(400).json({ "error": "end_time must be on the same day as start_time." });
            }
            const hours = (endTime - startTime) / (1000 * 60 * 60);
            if (hours < 1) {
                return res.status(400).json({ "error": "Timecard must be at least 1 hour." });
            }
            const startTimeHours = startTime.getHours() * 60 + startTime.getMinutes();
            const endTimeHours = endTime.getHours() * 60 + endTime.getMinutes();
            const clockInEarliest = 480;
            const clockOutLatest = 1080;
            if (startTimeHours < clockInEarliest || endTimeHours > clockOutLatest) {
                return res.status(400).json({ "error": "Timecard must be between 8:00 AM and 6:00 PM." });
            }

            const originalTimecard = await dl.getTimecard(timecard_id);
            const newTimecard = new dl.Timecard(start_time, end_time, emp_id);
            originalTimecard.setStartTime(newTimecard.getStartTime());
            originalTimecard.setEndTime(newTimecard.getEndTime());
            originalTimecard.setEmpId(newTimecard.getEmpId());
            dl.updateTimecard(originalTimecard);
            return res.status(201).json({ "response": `Timecard updated successfully for timecard_id ${timecard_id}.` });
        } catch (err) {
            return res.status(500).json({ "error": err.message });
        }
    });

    router.delete('/timecard', async function (req, res) {
        const {companyName, timecard_id} = req.query;
        if (!companyName) {
            return res.status(400).json({ "error": "Missing companyName query parameter." });
        }
        if (companyName != "ec7233") {
            return es.status(400).json({ "error": "Invalid RIT companyName." });
        }
        if (!timecard_id) {
            return res.status(400).json({ "error": "Missing timecard_id query parameter." });
        }

        try {
            const timecard = await dl.deleteTimecard(timecard_id);
            if (timecard) {
                return res.json({ "response": `Timecard ${timecard_id} from ${companyName} deleted.` });
            } else {
                return res.status(404).json({ "error": `Timecard ${timecard_id} from ${companyName} not found` });
            }
        } catch (err) {
            return res.status(500).json({ "error": err.message });
        }
    });

    return router;
};
