export default async function ({ store, route, app }) {
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

    const resetAuth= () => {
        sessionStorage.removeItem('pasttime');
        return app.router.push('/admin/login');
    }
}