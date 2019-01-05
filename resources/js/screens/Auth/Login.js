import React, { Component, Fragment } from 'react';
import LoginForm from '../../components/Auth/LoginForm';
import Header from '../../inc/Header';
import Footer from '../../inc/Footer';

class LoginScreen extends Component {
	render() {
		return (
			<Fragment>
				<Header />

				<section className="container">
					<div className="row justify-content-center align-items-center" style={{ height: '100vh' }}>
						<div className="col">
							<LoginForm />
						</div>
					</div>
				</section>
				
				<Footer />
			</Fragment>
		);
	}
}

export default LoginScreen;