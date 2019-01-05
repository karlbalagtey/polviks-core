import React from 'react';

const Checkbox = props => {
	return (
        <div className="form-group row">
            <div className="col-md-6 offset-md-4">
                <div className="form-check">
                    <input 
                    	className="form-check-input" 
                    	type={props.inputType} 
                    	name={props.name} 
                    	id={props.name} 
                        value={props.value}
                        onChange={props.handleChange}
                        required={props.required}
                    />

                    <label 
                    	className="form-check-label" 
                    	htmlFor={props.name}>
                        {props.title}
                    </label>
                </div>
            </div>
        </div>
	);
};

export default Checkbox;