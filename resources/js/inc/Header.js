import React, { Component } from 'react';
import { NavLink } from 'react-router-dom';
import Auth from '../components/Auth/Auth';

class Header extends Component {
	state = {
		authUser: ''
	};

	handleLogout = () => {
		localStorage.removeItem('accessToken');
		localStorage.removeItem('refreshToken');
		localStorage.removeItem('expiresIn');
		localStorage.removeItem('authUser');
	};

	renderLogin() {
		const isLoggedIn = localStorage.getItem('accessToken');
		const authUser = JSON.parse(localStorage.getItem('authUser'));

		if (isLoggedIn && authUser) {
			return(
	            <li className="nav-item dropdown">
	                <a href="#" id="navbarDropdown" className="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{authUser.first_name} {authUser.last_name}</a>
	                <div className="dropdown-menu" aria-labelledby="navbarDropdown">
	                	<a className="dropdown-item" href="#">Profile</a>
	                	<div className="dropdown-divider"></div>
	                	<a className="dropdown-item" href="#" onClick={this.handleLogout}>Logout</a>
	                </div>
	            </li>
			);			
		}

		return(
            <li className="nav-item">
                <NavLink to="/login" className="nav-link">Login</NavLink>
            </li>
		);
	}

	render () {
		const headerTitle = 'Konnektion';

		return (
			<nav className="navbar navbar-expand-lg navbar-dark bg-dark header-admin">
			    <div className="container">
			        <NavLink className="navbar-brand" to="/">{ headerTitle }</NavLink>
			        <button className="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			            <span className="navbar-toggler-icon"></span>
			        </button>

			        <div className="collapse navbar-collapse" id="navbarSupportedContent">
			            <ul className="navbar-nav mr-auto">
			                <li className="nav-item">
			                    <NavLink className="nav-link" to="/dashboard">Dashboard</NavLink>
			                </li>
			                <li className="nav-item">
			                    <NavLink className="nav-link" to="/products">Products</NavLink>
			                </li>
			                <li className="nav-item">
			                    <NavLink className="nav-link" to="/admin/events">Events</NavLink>
			                </li>
			            </ul>

			            <ul className="navbar-nav ml-auto">
			                {this.renderLogin()}
			            </ul>
			        </div>
			    </div>
			</nav>
		)
	}
}

export default Header;