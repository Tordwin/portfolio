//Load
import {useState, useEffect} from 'react'
import getData from '../utils/getData';
//Import CSS HERE
import './css/Minors.css'
//External Components
//Breadcrumbs
import BasicBreadcrumbs from '../utils/breadcrumbs';
//Progress Circle
import CircularIndeterminate from '../utils/progressCircle';
import { Link } from 'react-router-dom';

const Minors = () => {
    //Variables
    const [minorsObj, setMinorsObj] = useState();
    const [loaded, setLoaded] = useState(0);
    const [minor, setMinor] = useState();
    const [minorDetails, setMinorDetails] = useState();

    //Grabbing data
    useEffect(() => {
        getData('minors/').then((json) => {
            console.log("Minors page has loaded", json);
            setMinorsObj(json);
        })

        //Timer so progress circle is shown
        const timer = setTimeout(() => {
            setLoaded(true);
        }, 1000);
    }, []); 

    //If it hasn't loaded yet it display loading and progress circle
    if (!loaded) return (
        <>
            <h2 id='loading'>Minors Page is Loading...<CircularIndeterminate /></h2>
        </>
    )

    //URL should follow "minors/UgMinors/name=minorName"
    //Grabs data and sets it to minorDetails
    //Returns data
    const loadMinorDetails = (minorName) => {
        setMinor(minorName);
        setMinorDetails(null);
        getData(`minors/UgMinors/name=${minorName}`).then((json) => {
            setMinorDetails(json);
        });
    }

    //Checks for values and returns data
    if (minor && minorDetails) {
        return (
            <>
                <div id='minorDetails'>
                    <h2>{minorDetails.title}</h2>
                    <p>{minorDetails.description}</p>
                    <h3>Courses</h3>
                    <ul>
                        {minorDetails.courses.map((c, index) => 
                            <li key={c || index}>{c}</li>
                        )}
                    </ul>
                </div>
            </>
        )
    }

    //Fields to return (Minors):
    //name
    //title
    //description
    //courses

    return (
        <>
            {/* Breadcrumb */}
            <BasicBreadcrumbs />
            
            {/* Returning Data */}
            <div id='minorsContainer'>
                <h2>Minors</h2>
                {minorsObj.UgMinors.map((minor, index) => (
                    <div key={minor.id || index} id='minorsContainer'>
                        <h3>
                            {/* Sorry...could not figure out how to change it to a different href */}
                            <Link to={`#`}
                                onClick={() => loadMinorDetails(minor.name)}>{minor.title}
                            </Link>
                        </h3>
                    </div>
                ))}
            </div>
        </>
    )
}
export default Minors;