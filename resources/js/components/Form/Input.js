import React from 'react';

const Input = props => {
	return (
        <div className="form-group row">
            <label 
            	htmlFor={props.name} 
            	className="col-sm-4 col-form-label text-md-right">
            	{props.title}
            </label>

            <div className="col-md-6">
                <input 
                	id={props.name}
                	type={props.inputType} 
                	className="form-control" 
                	name={props.name}
                	value={props.value}
                	onChange={props.handleChange}
                	placeholder={props.placeholder}
                	required={props.required}
                	autoFocus={props.autofocus}
                />
            </div>
        </div>
	);
};

export default Input;