//Degrees: https://ischool.gccis.rit.edu/api/degrees/
//Minors: https://ischool.gccis.rit.edu/api/minors/
//Employment: https://ischool.gccis.rit.edu/api/employment/
//People: https://ischool.gccis.rit.edu/api/people/
//Courses: https://ischool.gccis.rit.edu/api/courses/


//This is the base of my proxy to grab data from the API
const proxyServer = "https://solace.ist.rit.edu/~dsbics/proxy/https://ischool.gccis.rit.edu/api/"

async function getData(endpoint) {
    const result = await fetch(`${proxyServer}${endpoint}`);
    return await result.json();
}

export default getData;