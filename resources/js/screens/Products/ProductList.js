import React, { Component, Fragment } from 'react';
import Header from '../../inc/Header';
import Footer from '../../inc/Footer';
import Products from '../../components/Products/ProductsList';

class ProductList extends Component {
	render() {
		return (
			<section>
				<Header />
					<section className="container">
						<Products />
					</section>
				<Footer />
			</section>
		)
	}
}

export default ProductList;