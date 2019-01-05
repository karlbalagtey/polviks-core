import React from 'react';

const Button = props => {
	return (
		<button
			id={props.name}
			className={props.className}
			type={props.type}
			onClick={props.action}
		>
			{props.title}
		</button>
	);
}

export default Button;