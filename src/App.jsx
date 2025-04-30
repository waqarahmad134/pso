import { useEffect, useState } from 'react';
import { Route, Routes, useLocation } from 'react-router-dom';
import { ChakraProvider } from '@chakra-ui/react';
import { ToastContainer } from 'react-toastify';

import Loader from './common/Loader';
import PageTitle from './components/PageTitle';
import SignIn from './pages/Authentication/SignIn';
import PrivateRoute from './components/PrivateRoute';
import Movies from './pages/Movies';
import Profile from './pages/Profile';
import Categories from './pages/Categories';
import AddMovie from './pages/AddMovie';

function App() {
  const [loading, setLoading] = useState(true);
  const { pathname } = useLocation();

  useEffect(() => {
    window.scrollTo(0, 0);
  }, [pathname]);

  useEffect(() => {
    setTimeout(() => setLoading(false), 1000);
  }, []);

  return loading ? (
    <Loader />
  ) : (
    <>
      <ToastContainer />
      <ChakraProvider>
        <Routes>
          <Route
            path="/auth/signin"
            element={
              <>
                <PageTitle title="Signin || Admin Dashboard" />
                <SignIn />
              </>
            }
          />
          <Route
            path="/"
            element={
              <>
                <PageTitle title="Home | Admin Dashboard" />
                <Movies />
              </>
            }
          />
          <Route
            path="/form"
            element={
              <>
                <PageTitle title="Form | Admin Dashboard" />
                <Categories />
              </>
            }
          />
          <Route
            path="/add-form"
            element={
              <>
                <PageTitle title="Add Form | Admin Dashboard" />
                <AddMovie />
              </>
            }
          />
          {/* <Route
            path="/add-form"
            element={
              <PrivateRoute
                element={
                  <>
                    <PageTitle title="Add New Movie | Admin Dashboard" />
                    <AddMovie />
                  </>
                }
              />
            }
          /> */}
          {/* <Route
            path="/edit-movie"
            element={
              <PrivateRoute
                element={
                  <>
                    <PageTitle title="Add New Movie | Admin Dashboard" />
                    <EditMovie />
                  </>
                }
              />
            }
          /> */}
          <Route
            path="/profile"
            element={
              <PrivateRoute
                element={
                  <>
                    <PageTitle title="Profile | Admin Dashboard" />
                    <Profile />
                  </>
                }
              />
            }
          />
        </Routes>
      </ChakraProvider>
    </>
  );
}

export default App;
