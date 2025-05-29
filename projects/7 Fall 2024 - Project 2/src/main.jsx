import { createRoot } from 'react-dom/client'
import React from 'react';
import './index.css'
//React Components
import { createHashRouter, RouterProvider } from 'react-router-dom'
import Layout from './components/layout.jsx';
import About from './components/about.jsx';
import Degrees from './components/degrees.jsx';
import Employment from './components/employment.jsx';
import Minors from './components/minors.jsx';
import People from './components/people.jsx';

const router = createHashRouter([
  {
    path: "/",
    element: <Layout />,
    children: [
      {
        path: "/",
        element: <About />
      },
      {
        path: "/degrees",
        element: <Degrees />
      },

      {
        path: "/employment",
        element: <Employment />
      },

      {
        path: "/minors",
        element: <Minors />
      },

      {
        path: "/people",
        element: <People />
      }
    ]
  }
])


createRoot(document.getElementById('root')).render(
  <RouterProvider router={router}/>
)
