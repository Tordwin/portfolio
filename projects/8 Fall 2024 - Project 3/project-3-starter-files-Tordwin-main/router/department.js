const express = require('express');

module.exports = function(dl) {
    const router = express.Router();

    router.get('/department', async function (req, res) {
        const { companyName, dept_id} = req.query;
        if (!companyName) {
            return res.status(400).json({ "error": "Missing companyName query parameter." });
        }
        if (companyName != "ec7233") {
            return res.status(400).json({ "error": "Invalid RIT companyName." });
        }
        if (!dept_id) {
            return res.status(400).json({ "error": "Missing dept_id query parameter." });
        }

        try {
            const department = await dl.getDepartment(companyName, dept_id);
            if (department) {
                return res.json(department);
            } else {
                return res.status(404).json({ "error": `Department ${dept_id} not found` });
            }
        } catch (err) {
            return res.status(500).json({ "error": err.message });
        }
    });

    router.get('/departments', async function (req, res) {
        const { companyName } = req.query;
        if (!companyName) {
            return res.status(400).json({ "error": "Missing companyName query parameter." });
        }
        if (companyName != "ec7233") {
            return res.status(400).json({ "error": "Invalid RIT companyName." });
        }

        try {
            const departments = await dl.getAllDepartment(companyName);
            if (departments && departments.length > 0) {
                return res.json(departments);
            } else {
                return res.status(404).json({ "error": `No departments found for company: ${companyName}.` });
            }
        } catch (err) {
            return res.status(500).json({ "error": err.message });
        }
    });

    router.put('/department', async function (req, res) {
        const { companyName, dept_id, dept_name, dept_no, location } = req.body;
        if (!companyName || !dept_id || !dept_name || !dept_no || !location) {
            return res.status(400).json({ "error": "Missing required fields." });
        }

        try {
            if (companyName != "ec7233") {
                return res.status(400).json({ "error": "Invalid RIT companyName." });
            }
            const originalDeptNo = await dl.getDepartmentNo(companyName, dept_no);
            if (originalDeptNo) {
                return res.status(400).json({ "error": `dept_no ${dept_no} already exists.` });
            }
            const originalDepartment = await dl.getDepartment(companyName, dept_id);
            if (!originalDepartment) {
                return res.status(404).json({ "error": `Department ${dept_id} not found` });
            }
            
            const newDepartment = new dl.Department(companyName, dept_name, dept_no, location);
            originalDepartment.setDeptName(newDepartment.getDeptName());
            originalDepartment.setDeptNo(newDepartment.getDeptNo());
            originalDepartment.setLocation(newDepartment.getLocation());
            dl.updateDepartment(originalDepartment);
            return res.json({ "response": `Department ${dept_id} updated successfully.` });
        } catch (err) {
            return res.status(500).json({ "error": err.message });
        }
    });

    router.post("/department", async function(req, res) {
        const { companyName, dept_name, dept_no, location } = req.body;
        if (!companyName || !dept_name || !dept_no || !location) {
            return res.status(400).json({ "error": "Missing required fields." });
        }
    
        try {
            if (companyName != "ec7233") {
                return res.status(400).json({ "error": "Invalid RIT companyName." });
            }
            const existingDept = await dl.getDepartmentNo(companyName, dept_no);
            if (existingDept) {
                return res.status(400).json({ "error": `dept_no ${dept_no} already exists.` });
            }
            const newDepartment = new dl.Department(companyName, dept_name, dept_no, location);
            await dl.insertDepartment(newDepartment);
            const departmentData = await dl.getDepartmentNo(companyName, dept_no);
            return res.status(201).json({
                success: {
                    dept_id: departmentData.dept_id, 
                    companyName: departmentData.company,
                    dept_name: departmentData.dept_name,
                    dept_no: departmentData.dept_no,
                    location: departmentData.location
                }
            });
        } catch (err) {
            return res.status(500).json({ "error": err.message });
        }
    });
    
    router.delete('/department', async function (req, res) {
        const {companyName, dept_id} = req.query;
        if (!companyName) {
            return res.status(400).json({ "error": "Missing companyName query parameter." });
        }
        if (companyName != "ec7233") {
            return res.status(400).json({ "error": "Invalid RIT companyName." });
        }
        if (!dept_id) {
            return res.status(400).json({ "error": "Missing dept_id query parameter." });
        }

        try {
            const department = await dl.deleteDepartment(companyName, dept_id);
            if (department) {
                return res.json({ "response": `Department ${dept_id} from ${companyName} deleted.` });
            } else {
                return res.status(404).json({ "error": `Department ${dept_id} from ${companyName} not found` });
            }
        } catch (err) {
            return res.status(500).json({ "error": err.message });
        }
    });

    return router;
};
