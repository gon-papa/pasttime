export default ({ $axios }) => {
    $axios.onRequest(config => {
        config.headers.common['Accept'] = 'application/json';
    });
}