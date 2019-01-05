import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import { Router, Route, Switch } from 'react-router-dom';
import { Provider } from 'react-redux';
import { createStore, applyMiddleware } from 'redux';
import reduxThunk from 'redux-thunk';

import reducers from '../reducers';
import history from '../history';
import WelcomeScreen from './WelcomeScreen';
import ProductScreen from './Products/ProductList';
import DashboardScreen from './Dashboard';
import LoginScreen from './Auth/Login';

const store = createStore(
    reducers,
    {},
    applyMiddleware(reduxThunk)
);

class App extends Component {
    render() {
        return (
            <Router history={history}>
                <div>
                    <Route exact path='/' component={WelcomeScreen} />
                    <Route path='/products' component={ProductScreen} />
                    <Route path='/dashboard' component={DashboardScreen} />
                    <Route path='/login' component={LoginScreen} />
                </div>
            </Router>
        );
    }
}

ReactDOM.render(
    <Provider store={store}>
        <App />
    </Provider>, 
    document.getElementById('app')
);