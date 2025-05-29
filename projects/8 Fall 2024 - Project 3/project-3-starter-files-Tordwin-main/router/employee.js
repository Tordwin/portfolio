const express = require('express');

module.exports = function(dl) {
    const router = express.Router();

    router.get('/employee', async function (req, res) {
        const { companyName, emp_id} = req.query;
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
            const employee = await dl.getEmployee(emp_id);
            if (employee) {
                return res.json(employee);
            } else {
                return res.status(404).json({ "error": `Employee ${emp_id} not found` });
            }
        } catch (err) {
            return res.status(500).json({ "error": err.message });
        }
    });

    router.get('/employees', async function (req, res) {
        const { companyName } = req.query;
        if (!companyName) {
            return res.status(400).json({ "error": "Missing companyName query parameter." });
        }
        if (companyName != "ec7233") {
            return res.status(400).json({ "error": "Invalid RIT companyName." });
        }

        try {
            const employees = await dl.getAllEmployee(companyName);
            if (employees && employees.length > 0) {
                return res.json(employees);
            } else {
                return res.status(404).json({ "error": `No employees found for company: ${companyName}.` });
            }
        } catch (err) {
            return res.status(500).json({ "error": err.message });
        }
    });

    router.post('/employee', async function (req, res) {
        const { companyName, emp_name, emp_no, hire_date, job, salary, dept_id, mng_id } = req.body;
        if (!companyName || !emp_name || !emp_no || !hire_date || !job || !salary || !dept_id || !mng_id) {
            return res.status(400).json({ "error": "Missing required fields." });
        }

        try {
            if (companyName != "ec7233") {
                return res.status(400).json({ "error": "Invalid RIT companyName." });
            }
            const department = await dl.getDepartment(companyName, dept_id);
            if (department == null) {
                return res.status(400).json({ "error": `Department ${dept_id} does not exist.` });
            }
            if (mng_id >= 1) {
                return res.status(400).json({ "error": "Must be an existing user to be a manager." });
            }
            const hireDate = new Date(hire_date);
            const currDate = new Date();
            if (hireDate > currDate) {
                return res.status(400).json({ "error": `hire_date ${hire_date} is in the future.` });
            }
            const dayOfWeek = hireDate.getDay();
            if (dayOfWeek === 0 || dayOfWeek === 6) {
                return res.status(400).json({ "error": `hire_date ${hire_date} is on a weekend.` });
            }
            const existEmpNo = await dl.getAllEmployee(companyName);
            for (let i = 0; i < existEmpNo.length; i++) {
                if (existEmpNo[i].getEmpNo() === emp_no) {
                    return res.status(400).json({ "error": `emp_no ${emp_no} already exists.` });
                }
            }

            const newEmployee = new dl.Employee(emp_name, emp_no, hire_date, job, salary, dept_id, mng_id)
            dl.insertEmployee(newEmployee);
            return res.status(201).json({ "response": `Employee ${emp_name} added successfully.` });
        } catch (err) {
            return res.status(500).json({ "error": err.message });
        }
    });

    router.put('/employee', async function (req, res) {
        const { companyName, emp_id, emp_name, emp_no, hire_date, job, salary, dept_id, mng_id } = req.body;
        if (!companyName || !emp_id || !emp_name || !emp_no || !hire_date || !job || !salary || !dept_id || !mng_id) {
            return res.status(400).json({ "error": "Missing required fields." });
        }
    
        try {
            const originalEmployee = await dl.getEmployee(emp_id);
            if (!originalEmployee) {
                return res.status(404).json({ "error": `Employee ${emp_id} not found` });
            }
            if (companyName != "ec7233") {
                return res.status(400).json({ "error": "Invalid RIT companyName." });
            }
            const department = await dl.getDepartment(companyName, dept_id);
            if (department == null) {
                return res.status(400).json({ "error": `Department ${dept_id} does not exist.` });
            }
            const hireDate = new Date(hire_date);
            const currDate = new Date();
            if (hireDate > currDate) {
                return res.status(400).json({ "error": `hire_date ${hire_date} is in the future.` });
            }
            const dayOfWeek = hireDate.getDay();
            if (dayOfWeek === 0 || dayOfWeek === 6) {
                return res.status(400).json({ "error": `hire_date ${hire_date} is on a weekend.` });
            }
            const existEmpNo = await dl.getAllEmployee(companyName);
            for (let i = 0; i < existEmpNo.length; i++) {
                if (existEmpNo[i].getEmpNo() === emp_no) {
                    return res.status(400).json({ "error": `emp_no ${emp_no} already exists.` });
                }
            }

            const newEmployee = new dl.Employee(emp_name, emp_no, hire_date, job, salary, dept_id, mng_id)
            originalEmployee.setEmpName(newEmployee.getEmpName());
            originalEmployee.setEmpNo(newEmployee.getEmpNo());
            originalEmployee.setHireDate(newEmployee.getHireDate());
            originalEmployee.setJob(newEmployee.getJob());
            originalEmployee.setSalary(newEmployee.getSalary());
            originalEmployee.setDeptId(newEmployee.getDeptId());
            originalEmployee.setMngId(newEmployee.getMngId());
            dl.updateEmployee(originalEmployee);
            return res.json({ "response": `Employee ${emp_id} updated successfully.` });
        } catch (err) {
            return res.status(500).json({ "error": err.message });
        }
    });

    router.delete('/employee', async function (req, res) {
        const {companyName, emp_id} = req.query;
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
            const employee = await dl.deleteEmployee(emp_id);
            if (employee) {
                return res.json({ "response": `Employee ${emp_id} from ${companyName} deleted.` });
            } else {
                return res.status(404).json({ "error": `Employee ${emp_id} from ${companyName} not found` });
            }
        } catch (err) {
            return res.status(500).json({ "error": err.message });
        }
    });

    return router;
};
