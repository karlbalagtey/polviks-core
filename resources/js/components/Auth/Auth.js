import React, { Component } from 'react';
import { NavLink } from 'react-router-dom';

class Auth extends Component {
	state = { isSignedIn: null };

	componentDidMount() {
		const CLIENT_SECRET = process.env.MIX_CLIENT_PASSWORD_SECRET;
		const CLIENT_ID = process.env.MIX_CLIENT_PASSWORD_ID;
		const OAUTH_URL = process.env.MIX_OAUTH_URL;

	}

	renderAuthButton() {
		if (this.state.isSignedIn === null) {
			return <div>I dont know if signed in</div>
		} else if (this.state.isSignedIn) {
			return <div>I am signed in!</div>
		} else {
			return <NavLink to="/login" className="nav-link">Login</NavLink>
		}
	}

	render() {
		return (
			<div>{this.renderAuthButton()}</div>
		);
	}

}

export default Auth;