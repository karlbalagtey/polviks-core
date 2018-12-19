import React from 'react'

const CarouselItem = (props) => {
	return (
		<div className={props.active ? 'carousel-item active': 'carousel-item'}>
	      	<img className="d-block w-100" src={props.src} alt={"Image of " + props.alt} />
	    </div>
	);
};

export default CarouselItem;