import VueRouter from 'vue-router';

let routes = [

{
	path: '/dashboard',
	component: require('./views/Dashboard')
},
{
	path: '/drivers',
	component: require('./views/Drivers')
},
{
	path: '/trucks',
	component: require('./views/Trucks')
},
{
	path: '/haulers',
	component: require('./views/Haulers')
},
{
	path: '/users',
	component: require('./views/Users')
},
{
	path: '/in-plant',
	component: require('./views/Inplant')
},
{
	path: '/in-transit',
	component: require('./views/Intransit')
},
{
	path: '/entires',
	component: require('./views/Entries')
}

];

export default new VueRouter({
	routes
	// linkActiveClass: ''
});