import React, { Component } from 'react';
import { NavLink, withRouter } from 'react-router-dom';
import Input from '../Form/Input';
import Checkbox from '../Form/Checkbox';
import Button from '../Form/Button';
import Auth from './Auth';
import history from '../../history';

class LoginForm extends Component {
	state = {
		user: {
			email: '',
			password: '',
			remember: false
		},
		error: {
			message: ''
		}
	};

	handleSubmit = (e) => {
		e.preventDefault();
		const CLIENT_SECRET = process.env.MIX_CLIENT_PASSWORD_SECRET;
		const CLIENT_ID = process.env.MIX_CLIENT_PASSWORD_ID;
		const OAUTH_URL = process.env.MIX_OAUTH_URL;

		var formData = new FormData();
		formData.append('client_id', CLIENT_ID);
		formData.append('client_secret', CLIENT_SECRET);
		formData.append('provider', 'customers');
		formData.append('grant_type', 'password');
		formData.append('username', this.state.user.email);
		formData.append('password', this.state.user.password);

		axios.post(OAUTH_URL, formData)
			.then(response => {
				localStorage.setItem('accessToken', response.data.access_token);
				localStorage.setItem('refreshToken', response.data.refresh_token);
				localStorage.setItem('expiresIn', response.data.expires_in);

				this.handleLogin();
			})
			.catch(error => {
				console.log(error);
				this.setState({
					error: {
						message: error.response.data.message
					}
				});
				console.log(this.state.error.message);
			});
	};

	handleInput = (e) => {
		let value = e.target.value;
		let name = e.target.name;

		this.setState(
			prevState => ({
				user: {
					...prevState.user,
					[name]: value
				}
			}),
			() => console.log(this.state.user)
		);
	};

	handleEmail = (e) => {
		let value = e.target.value;

		this.setState(
			prevState => ({
				user: {
					email: value
				}
			}),
			() => console.log(this.state.user.email)
		);
	};

	handleCheckbox = (e) => {
		let value = e.target.checked;

		this.setState(
			prevState => ({
				user: { ...prevState.user, remember: value }
			}),
			() => console.log(this.state.user)
		);
	};

	handleLogin = () => {
		const accessToken = localStorage.getItem('accessToken');
		const headers = {
			'Content-Type': 'application/json',
			'Authorization': 'Bearer ' + accessToken
		}

		axios.get('/api/auth/customer', {headers: headers})
			.then(response => {
				localStorage.setItem('authUser', JSON.stringify(response.data));
				history.push('/products');
			})
			.catch(error => {
				console.log(error);
			});
	};

	handleError() {
		if (this.state.error.message) {
			return (
				<div className="row">
					<div className="col-md-6 offset-md-4">
						<span className="invalid-feedback d-block">
		                    <strong>{ this.state.error.message }</strong>
		                </span>
		            </div>
	            </div>
			);
		}

	};

	render() {
		return (
	        <form method="POST" onSubmit={this.handleSubmit}>
	        	{this.handleError()}
				<Input 
					inputType={'email'}
					title={"Email Address"}
					name={'email'}
					value={this.state.user.email}
					placeholder={'Enter your email address'}
					handleChange={this.handleInput}
					required={true}
				/>

				<Input
					inputType={'password'}
					title={'Password'}
					name={'password'}
					value={this.state.user.password}
					placeholder={'***********'}
					handleChange={this.handleInput}
					required={true}
				/>

				<Checkbox
					inputType={'checkbox'}
					title={'Remember Me'}
					name={'remember'}
					value={this.state.user.remember}
					handleChange={this.handleCheckbox}
				/>

	            <div className="form-group row mb-0">
	                <div className="col-md-8 offset-md-4">
	                	<Button
	                		title={'Login'}
	                		type={'submit'}
	                		className={'btn btn-primary'}
	                	/>

	                    <NavLink className="btn btn-link" to="/forgot">
	                        Forgot your password
	                    </NavLink>
	                </div>
	            </div>
	        </form>
		);		
	}
}

export default LoginForm;