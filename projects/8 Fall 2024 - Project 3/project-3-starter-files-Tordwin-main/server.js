var express = require("express");
var DataLayer = require("./companydata/index.js");
var dl = new DataLayer("ec7233");
//now use dl.Department, dl.Employee and dl.TimeCard
var logger = require('morgan');

var app = express();

app.use(logger('dev'));
app.use(express.json());
app.use(express.urlencoded({ extended: true }));

//use router if you'd like
const departmentRouter = require("./router/department.js")(dl);
const employeeRouter = require("./router/employee.js")(dl);
const timecardRouter = require("./router/timecard.js")(dl);

app.use('/CompanyServices', departmentRouter);
app.use('/CompanyServices', employeeRouter);
app.use('/CompanyServices', timecardRouter);

//use appropriate routes/paths/verbs
app.get("/",async function(req,res){
    //call the appropriate dl methods/objects using
    //await as the data layer methods are asynchronous
    res.json({"response":"this is the appropriate response"});  
});

app.delete("/CompanyServices/company", async function (req, res) {
    const companyName = req.query.companyName;
    if (!companyName) {
        res.status(400).json({ "error": "Missing company query parameter." });
        return;
    }

    try {
        const rows = await dl.deleteCompany(companyName);
        if (rows > 0) {
            res.json({ "response": `Company ${companyName} deleted ${rows} number of rows successfully.`})
        } else {
            res.status(404).json({ "error": `Company ${companyName} not found` });
        }
    } catch (err) {
        res.status(500).json({ "error": err.message });
    }
});

app.listen(8282);
console.log('Express started on port 8282');

