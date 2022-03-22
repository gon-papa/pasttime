export default function ({ store, route, app }) {
    if (route.name !== 'admin-Login___ja') {
        let session = sessionStorage.getItem('pasttime');
        let sessionItem = JSON.parse(session);
        if(sessionItem.user == null){
            console.log(app.router);
            return app.router.push('/admin/login');
        }
    }
}