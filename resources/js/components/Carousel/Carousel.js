import React from 'react';
import CarouselItem from './CarouselItem';

const Carousel = (props) => {
	const images = props.img;

	return (
		<div id={props.id} className="carousel slide" data-ride="carousel">
		  	<div className="carousel-inner">
		  		{ images.map((img, i) =>	
		  			<CarouselItem key={i} src={img.mobile_url} active={i===0} alt={img.product_id} />
		  		)}
		  	</div>

		  	<a className="carousel-control-prev" href={"#" + props.id } role="button" data-slide="prev">
		    	<span className="carousel-control-prev-icon" aria-hidden="true"></span>
		    	<span className="sr-only">Previous</span>
		  	</a>
		  	<a className="carousel-control-next" href={"#" + props.id } role="button" data-slide="next">
		    	<span className="carousel-control-next-icon" aria-hidden="true"></span>
		    	<span className="sr-only">Next</span>
		  	</a>
		</div>
	)
};

export default Carousel;