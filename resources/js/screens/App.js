import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import { BrowserRouter, Route, Switch } from 'react-router-dom';
import WelcomeScreen from './WelcomeScreen';

class App extends Component {
    render() {
        return (
            <BrowserRouter>
                <div>
                    <Route exact path='/' component={WelcomeScreen} />
                </div>
            </BrowserRouter>
        );
    }
}

ReactDOM.render(<App />, document.getElementById('app'));