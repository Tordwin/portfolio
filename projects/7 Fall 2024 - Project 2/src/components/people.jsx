//Load
import {useState, useEffect} from 'react'
import getData from '../utils/getData'
//Import CSS HERE
import './css/People.css'
//External Components
//Breadcrumbs
import BasicBreadcrumbs from '../utils/breadcrumbs';
//Progress Circle
import CircularIndeterminate from '../utils/progressCircle';
import { Link } from 'react-router-dom';

const People = () => {
    //Variables
    const [peopleObj, setPeopleObj] = useState();
    const [loaded, setLoaded] = useState(0);
    const [people, setPeople] = useState();
    const [peopleDetails, setPeopleDetails] = useState();

    //Grabbing data
    useEffect(() => {
        getData(`people/`)
            .then((json)=>{
                console.log("People page has loaded", json);
                setPeopleObj(json);
        })

        //Timer so progress circle is shown
        const timer = setTimeout(() => {
            setLoaded(true);
        }, 1000);
    }, []); 

    //If it hasn't loaded yet it display loading and progress circle
    if (!loaded) return (
        <>
            <h2 id='loading'>People Page is Loading...<CircularIndeterminate /></h2>
        </>
    )

    //URL should follow "people/faculty or staff/username=peopleName"
    //Grabs data and sets it to peopleDetails
    //Returns data
    const loadPeopleDetails = (peopleName, type) => {
        setPeople(peopleName);
        setPeopleDetails(null);
        getData(`people/${type}/username=${peopleName}`).then((json) => {
            setPeopleDetails(json);
        });
    }

    //Checks for values and returns data
    if (people && peopleDetails) {
        return (
            <>
                <div id='peopleInfo'>
                    <p>
                        Interest Areas: {peopleDetails.interestArea}<br/>
                        Office: {peopleDetails.office}<br/>
                        Website: {peopleDetails.website}<br/>
                        Phone: {peopleDetails.phone}<br/>
                        Email: {peopleDetails.email}<br/>
                        Twitter: {peopleDetails.twitter}<br/>
                        Facebook: {peopleDetails.facebook}
                    </p>
                </div>
            </>
        )
    }

    //Fields to return:
    //username
    //name
    //tagline
    //imagePath
    //title
    //interestArea
    //office
    //website
    //phone
    //email
    //twitter
    //facebook

    return (
        <>
            <div>
                {/* Breadcrumb */}
                <BasicBreadcrumbs />

                {/* Returning Data */}
                <div className='top'>
                    <h2>{peopleObj.title}</h2>
                    <h3>Faculty</h3>
                </div>
                <div className='peopleList'>
                    {peopleObj.faculty.map((p, index) => (
                        <div key={p.id || index} className='peopleListItem'>
                            <div id='people'>
                                <h3>
                                    {/* Sorry...could not figure out how to change it to a different href */}
                                    <Link to={`#`}
                                        onClick={() => loadPeopleDetails(p.username, 'faculty')}>{p.name}
                                    </Link>
                                </h3>
                                <img src={p.imagePath} alt="faculty" />
                                <p>
                                    {p.tagline}<br/>
                                    {p.title}
                                </p>
                            </div>

                            
                        </div>
                    ))}
                </div>
                <div className='top'>
                    <h3>Staff</h3>
                </div>
                <div className='peopleList'>
                    {peopleObj.staff.map((p, index) => (
                        <div key={p.id || index} className='peopleListItem'>
                            <div id='people'>
                                <h3>
                                    {/* Sorry...could not figure out how to change it to a different href */}
                                    <Link to={`#`}
                                        onClick={() => loadPeopleDetails(p.username, 'staff')}>{p.name}
                                    </Link>
                                </h3>
                                <img src={p.imagePath} alt="staff" />
                                <p>
                                    {p.tagline}<br/>
                                    {p.title}
                                </p>
                            </div>
                        </div>
                    ))}
                </div>
            </div>
        </>
    )
}
export default People;