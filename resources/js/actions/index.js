import { AUTH_USER } from './types';

export const signup = ({ email, password }) => {
	return function(dispatch) {
		dispatch({ type: AUTH_USER });
	}
};