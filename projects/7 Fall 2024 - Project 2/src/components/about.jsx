//Load
import {useState, useEffect} from 'react';
import getData from '../utils/getData';
//Import CSS HERE
import './css/About.css'
//External Components
//Breadcrumbs
import BasicBreadcrumbs from '../utils/breadcrumbs';
//Progress Circle
import CircularIndeterminate from '../utils/progressCircle';

const About = () => {
    //Variables
    const [aboutObj, setAboutObj] = useState();
    const [loaded, setLoaded] = useState(0);

    //Grabbing data
    useEffect(() => {
        getData('about/').then((json) => {
            console.log("About page has loaded", json);
            setAboutObj(json);
        })
        
        //Timer so progress circle is shown
        const timer = setTimeout(() => {
            setLoaded(true);
        }, 1000);
    }, []); 

    //If it hasn't loaded yet it display loading and progress circle
    if (!loaded) return (
        <>
            <h2 id='loading'>Home Page is Loading...<CircularIndeterminate /></h2>
        </>
    )

    //Fields to return:
    //title
    //description
    //quote
    //quoteAuthor

    return (
        <>
            {/* Breadcrumb */}
            <BasicBreadcrumbs />

            {/* Returning Data */}
            <h2 id='aboutH2'>{aboutObj.title}</h2>
            <div id='aboutContainer'>
                <p id='description'>{aboutObj.description}</p>
                <h3 id='quote'>"{aboutObj.quote}"</h3>
                <p id='author'>-{aboutObj.quoteAuthor}</p>
            </div>
        </>
    )
}
export default About;