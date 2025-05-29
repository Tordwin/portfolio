//Load
import {useState, useEffect} from 'react';
import getData from '../utils/getData';
//Import CSS HERE
import './css/Degrees.css'
//External Components
//Breadcrumbs
import BasicBreadcrumbs from '../utils/breadcrumbs';
//Progress Circle
import CircularIndeterminate from '../utils/progressCircle';
import { Link } from 'react-router-dom';

const Degrees = () => {
    //Variables
    const [degreesObj, setDegreesObj] = useState();
    const [loaded, setLoaded] = useState(0);
    const [degree, setDegree] = useState();
    const [degreeDetails, setDegreeDetails] = useState();

    //Grabbing data
    useEffect(() => {
        getData('degrees/').then((json) => {
            console.log("Degrees page has loaded", json);
            setDegreesObj(json);
        })

        //Timer so progress circle is shown
        const timer = setTimeout(() => {
            setLoaded(true);
        }, 1000);
    }, []); 

    //If it hasn't loaded yet it display loading and progress circle
    if (!loaded) return (
        <>
            <h2 id='loading'>Degrees Page is Loading...<CircularIndeterminate /></h2>
        </>
    )

    //URL should follow "degree/undergraduate or graduate/degreeName=degreeName"
    //Grabs data and sets it to degreeDetails
    //Returns data
    const loadDegreeDetails = (degreeName, type) => {
        setDegree(degreeName);
        setDegreeDetails(null);
        getData(`degrees/${type}/degreeName=${degreeName}`).then((json) => {
            setDegreeDetails(json);
        });
    }

    //Checks for values and returns data
    if (degree && degreeDetails) {
        return (
            <>
                <div id='degreeDetails'>
                    <h2>{degreeDetails.title}</h2>
                    <p>{degreeDetails.description}</p>
                    <h3>Concentrations</h3>
                    <ul>
                        {degreeDetails.concentrations.map((c, index) => 
                            <li key={c || index}>{c}</li>
                        )}
                    </ul>
                </div>
            </>
        )
    }

    //Fields to return:
    //The following sub-root nodes exist in this section:
        //undergraduate
        //graduate
    //Each child node has the following fields to be queried:
        //degreeName
        //title
        //description
        //concenteration

    return (
        <>
            {/* Breadcrumb */}
            <BasicBreadcrumbs />

            {/* Returning Data */}
            <div id='degreesContainer'>

                <h2>Undergraduate</h2>
                {degreesObj.undergraduate.map((degree, index) =>
                    <div key={degree.degreeName || index} id='undergraduateListItem'>
                        <h3>
                            {/* Sorry...could not figure out how to change it to a different href */}
                            <Link to={`#`} 
                                onClick={() => loadDegreeDetails(degree.degreeName, 'undergraduate')}>{degree.title}
                            </Link>
                        </h3>
                    </div>
                )}

                <h2>Graduate</h2>
                {degreesObj.graduate.map((degree, index) =>
                    <div key={degree.degreeName || index} id='graduateListItem'>
                        <h3>
                            {/* Sorry...could not figure out how to change it to a different href */}
                            <Link to={`#`} 
                                onClick={() => 
                                loadDegreeDetails(degree.degreeName, 'graduate')}>{degree.title}
                            </Link>
                        </h3>
                    </div>
                )}
                
            </div>
        </>
    )
}
export default Degrees;