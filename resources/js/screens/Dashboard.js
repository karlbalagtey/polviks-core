import React, { Component } from 'react';
import Header from '../inc/Header';
import Footer from '../inc/Footer';
import Products from '../components/Products/ProductsList';

class DashboardScreen extends Component {
	render() {
		return (
			<div>
				<Header />

				<section className="container">
					<div className="row">
						<div className="col">
							<h1>Welcome to the Dashboard</h1>
						</div>
					</div>
					
					<Products />
				</section>

				<Footer />				
			</div>
		);
	};
}

export default WelcomeScreen;