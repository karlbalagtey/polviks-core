import React, { Component } from 'react';
import ProductImage from './ProductImage';

class ProductDetail extends Component {
	render() {
		const product = this.props.product;

		return (
			<div className="col-12 col-md-4 mb-2" key={product.identifier}>
				<div className="product">
					<div className="product-images">
						<ProductImage images={product.images} />
					</div>
					<div className="product-title">{product.title}</div>
					<div className="product-body">
						<p className="product-text">{product.details}</p>
						<a href="#" className="btn btn-primary">More</a>
					</div>
				</div>
			</div>
		)
	}
}

export default ProductDetail;