export default async function ({ store, route, app }) {
    const resetAuth = function() {
        sessionStorage.removeItem('pasttime');
        app.router.push('/admin/login');
    }

    if (route.name !== 'admin-Login___ja') {
        try {
            let response = await app.$axios.$get('/check-auth');
            if(!response.message.result) {
                resetAuth();
            }
        } catch(err) {
            console.log(err);
            resetAuth();
        }
    }
}