import axios from 'axios';
export const getStudents = ({ commit }) => {
    return axios.get('http://localhost:8000/api/books')
        .then((response) => {
            commit('SET_STUDENTS', response.data);
        });
};
