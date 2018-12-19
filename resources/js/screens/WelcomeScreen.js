import React, { Component } from 'react';
import Header from '../inc/Header';
import Footer from '../inc/Footer';
import Products from '../components/Products/ProductsList';

class WelcomeScreen extends Component {
	render() {
		return (
			<div>
				<Header />

				<section className="container">
					<Products />
				</section>

				<Footer />				
			</div>
		);
	};
}

export default WelcomeScreen;