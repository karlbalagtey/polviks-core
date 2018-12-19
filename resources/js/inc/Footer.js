import React from 'react';

const Footer = () => {
	const footerText = 'Designed and built by UXB London';

	return(
		<footer className="bg-primary">
			<div className="container py-8">
				<p className="text-white text-right m-0">{footerText}</p>
			</div>
		</footer>
	);
}

export default Footer;