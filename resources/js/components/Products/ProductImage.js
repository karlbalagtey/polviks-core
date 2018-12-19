import React, { Component, Fragment } from 'react';
import {
	Carousel,
	CarouselItem,
	CarouselControl,
	CarouselIndicators
} from 'reactstrap';

class ProductImage extends Component {
	state = { activeIndex: 0 }

  	next = () => {
    	if (this.animating) return;
    	const nextIndex = this.state.activeIndex === this.props.images.length - 1 ? 0 : this.state.activeIndex + 1;
    	this.setState({ activeIndex: nextIndex });
  	}

  	previous = () => {
    	if (this.animating) return;
    	const nextIndex = this.state.activeIndex === 0 ? this.props.images.length - 1 : this.state.activeIndex - 1;
    	this.setState({ activeIndex: nextIndex });
  	}

	renderCarouselControls() {
		const isImages = this.props.images.length - 1;

		if (isImages) {
			return (
				<Fragment>
					<CarouselControl direction="prev" directionText="Previous" onClickHandler={this.previous} />
	  				<CarouselControl direction="next" directionText="Next" onClickHandler={this.next} />
				</Fragment>
			)
		}
	}

	render() {
		const { activeIndex } = this.state;

		const slides = this.props.images.map((item) => {
			return (
				<CarouselItem
					onExiting={() => this.animating = true}
					onExited={() => this.animating = false}
					key={item.mobile_url}
				>
					<img src={item.mobile_url} />
				</CarouselItem>
			);
		});

		return (
			<Carousel
				activeIndex={activeIndex}
				next={this.next}
				previous={this.previous}
			>
				{slides}
				{this.renderCarouselControls()}
			</Carousel>
		);
	}
}

export default ProductImage;