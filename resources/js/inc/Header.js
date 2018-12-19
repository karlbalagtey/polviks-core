import React, { Component } from 'react';
import { NavLink } from 'react-router-dom';

class Header extends Component {
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
			                    <NavLink className="nav-link" to="/home">Dashboard</NavLink>
			                </li>
			                <li className="nav-item">
			                    <NavLink className="nav-link" to="/admin/organisations">Organisation</NavLink>
			                </li>
			                <li className="nav-item">
			                    <NavLink className="nav-link" to="/admin/events">Events</NavLink>
			                </li>
			            </ul>

			            <ul className="navbar-nav ml-auto">
			                <li className="nav-item">
			                    <NavLink className="nav-link" to="/password">Password</NavLink>
			                </li>
			                <li className="nav-item">
			                    <a className="nav-link">Logout</a>
			                </li>
			            </ul>
			        </div>
			    </div>
			</nav>
		)
	}
}

export default Header;