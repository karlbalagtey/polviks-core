import React, { Component } from 'react';
import axios from 'axios';
import Spinner from '../../inc/Spinner';
import ProductDetail from './ProductDetail';

class ProductsList extends Component {
	state = {
		products: []
	}

	componentDidMount() {
		axios.get('http://polviks-core.test/api/products')
			.then(res => this.setState({ products: res.data.data }));
	}

	render() {
		if (this.state.products) {
			return (
				<section className="row my-4">
					{ this.state.products.map((product, index) => 
						<ProductDetail key={index} product={product} />
					)}
				</section>				
			);
		} else {
			<Spinner />
		}
	}
}

export default ProductsList;