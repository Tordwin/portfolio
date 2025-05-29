import { Link, Outlet } from "react-router-dom";

const Layout = () => {
    return (
        <>
            <header>
                <div id='header'>
                    <nav id="navigation">
                        <ul id="navbar">
                            <li id="title">
                                <h1><Link to='/'>Welcome to ISchool</Link></h1>
                            </li>
                            <li id="degrees">
                                <Link to="/degrees">Degrees</Link>
                            </li>
                            <li id="employment">
                                <Link to="/employment">Employment</Link>
                            </li>
                            <li id="minors">
                                <Link to="/minors">Minors</Link>
                            </li>
                            <li id="people">
                                <Link to="/people">People</Link>
                            </li>
                        </ul>
                    </nav>
                </div>
            </header>

            <Outlet/>

            <div id='wrapper'>
                <footer>
                    <p>Edwin Chen</p>
                    <p>React - Project 2</p>
                    <p>ISTE.340.01-2</p>
                </footer>
            </div>
        </>
    )
}
export default Layout;