//Load
import {useState, useEffect} from 'react'
import getData from '../utils/getData';
//Import CSS HERE
import './css/Employment.css'
//External Components
//Breadcrumbs
import BasicBreadcrumbs from '../utils/breadcrumbs';
//Progress Circle
import CircularIndeterminate from '../utils/progressCircle';
//Tables
import CustomizedTables from '../utils/tableEmp';
//Import Images
import careerfair from '../assets/images/careerfair.jpg'
import professional from '../assets/images/professional.jpg'

const Employment = () => {
    //Variables
    const [employmentObj, setEmploymentObj] = useState();
    const [loaded, setLoaded] = useState(0);

    //Grabbing data
    useEffect(() => {
        getData('employment/').then((json) => {
            console.log("Employment page has loaded", json);
            setEmploymentObj(json);
        })

        //Timer so progress circle is shown
        const timer = setTimeout(() => {
            setLoaded(true);
        }, 1000);
    }, []); 

    //If it hasn't loaded yet it display loading and progress circle
    if (!loaded) return (
        <>
            <h2 id='loading'>Employment Page is Loading...<CircularIndeterminate /></h2>
        </>
    )

    //Checks for no duplicates in coopTable and filters them out
    const noCoopDuplicates = employmentObj.coopTable.coopInformation.filter(
        (emp, index, self) =>
          index === self.findIndex((i) => i.employer === emp.employer)
    );

    //Checks for no duplicates in employmentTable and filters them out
    const noEmploymentDuplicats = employmentObj.employmentTable.professionalEmploymentInformation.filter(
        (emp, index, self) =>
          index === self.findIndex((i) => i.employer === emp.employer)
    );

    //Fields to return:
    //introduction
    //degreeStatistics
    //employers
    //careers
    //coopTable
    //employmentTable

    return (
        <>
            {/* Breadcrumb */}
            <BasicBreadcrumbs />

            {/* Returning Data */}
            <div id='employmentContainer'>
                <h1>{employmentObj.introduction.title}</h1>
                {employmentObj.introduction.content.map((emp, index) => 
                    <div key={emp.title || index} id='introContent'>
                        <h2>{emp.title}</h2>
                        <p>{emp.description}</p>
                    </div>
                )}
                
                <div id='empCarContainer'>
                    <img src={careerfair} alt="Career Fair Picture" style={{ minWidth: '500px', minHeight: '290px', paddingRight: '100px'}}/>
                    <div id='employersContainer'>
                        <h2>{employmentObj.employers.title}</h2>
                        {employmentObj.employers.employerNames.map((emp, index) => 
                            <div key={emp || index} id='employerNames'>
                                <p>{emp}</p>
                            </div>
                        )}
                    </div>
                    
                    <div id='careersContainer'>
                    <h2>{employmentObj.careers.title}</h2>
                    {employmentObj.careers.careerNames.map((emp, index) => 
                        <div key={emp || index} id='employerCareers'>
                            <p>{emp}</p>
                        </div>
                    )}
                    </div>
                    <img src={professional} alt="Professional Picture" style={{ minWidth: '500px', minHeight: '290px', paddingLeft: '100px' }} />
                </div>

                <h2 id='centerStats'>{employmentObj.degreeStatistics.title}</h2>
                <div id='degreeStatsContainer'>
                    {employmentObj.degreeStatistics.statistics.map((emp, index) => 
                        <div key={emp.title || index} id='empDegreeStats'>
                            <p id='degreeDesc'>{emp.description} </p>
                            <p id='empValue'>{emp.value}</p>
                        </div>
                    )}
                </div>

                {/* Tables Initiated Here */}
                <CustomizedTables />

            </div>
        </>
    )
}
export default Employment;