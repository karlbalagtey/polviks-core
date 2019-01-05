import { combineReducers } from 'redux';
import { reducers as formReducer } from 'redux-form';
import auth from './auth';

export default combineReducers({
	auth,
	form: formReducer
});