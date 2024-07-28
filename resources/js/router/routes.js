const Settings = () => import('../Views/Settings.vue');
const Profile = () => import('../Views/Profile.vue');
const Password = () => import('../Views/Password.vue');
const Login = () => import('../Views/Login.vue');
const ForgotPassword = () => import('../Views/ForgotPassword.vue');
const ResetPassword = () => import('../Views/ResetPassword.vue');
const VerifyEmail = () => import('../Views/VerifyEmail.vue');
const Register = () => import('../Views/Register.vue');
const Home = () => import('../Views/Home.vue');
const Welcome = () => import('../Views/Welcome.vue')
import FormComponent from '../Views/FormComponent.vue';
import OtherComponent from '../Views/OtherComponent.vue';
import MyHome from '../Views/MyHome.vue'; 
import UserProfiles from '../Views/UserProfiles.vue'; 

export default [{
        path: '/',
        component: Welcome,
        name: 'welcome',

    },
    {
        path: '/home',
        component: Home,
        name: 'home',
        meta: {
            guard: 'auth'
        }
    },
    {
        path: '/my-home',
        component: MyHome,
        name: 'home',
        meta: {
            guard: 'guest'
        }
    },
    {
        path: '/crud',
        component: UserProfiles,
        name: 'home',
        meta: {
            guard: 'guest'
        }
    },
    {
        path: '/login',
        component: Login,
        name: 'login',
        meta : {
            guard : 'guest'
        }
    },
    {
        path: '/forgot-password',
        component: ForgotPassword,
        name: 'forgot-password',
        meta : {
            guard : 'guest'
        }
    },
    {
        path: '/reset-password/:token',
        props: route => ({
            token: route.params.token,
            email: route.query.email
        }),
        component: ResetPassword,
        name: 'reset-password',
        meta : {
            guard : 'guest'
        }
    },
    {
        path: '/register',
        component: Register,
        name: 'register',
        meta : {
            guard : 'guest'
        }
    },
    {
        path: '/verify-email/:id/:hash',
        props: route => ({
            id: route.params.id,
            hash: route.params.hash           
        }),
        component: VerifyEmail,
        name: 'verify-email',

    },
    {
        path: '/settings',
        component: Settings,
        redirect: {
            name: 'profile'
        },
        name: 'settings',
        meta: {
            guard: 'auth'
        },
        children: [{
                path: 'profile',
                component: Profile,
                name: 'profile',
                meta: {
                    guard: 'auth'
                },

            },
            {
                path: 'password',
                component: Password,
                name: 'password',
                meta: {
                    guard: 'auth'
                },

            },

        ]
    },
    { path: '/form', component: FormComponent, name: 'Myform', },
    {
        path: '/:pathMatch(.*)*',
        redirect: '/home',

    },
   
    {
        path: '/other',
        component: OtherComponent,
        // beforeEnter: async (to, from, next) => {
        //   try {
        //     const response = await axios.get('/api/forms/user');
        //     if (response.data && response.data.is_approved) {
        //       next();
        //     } else {
        //       next('/form');
        //     }
        //   } catch (error) {
        //     next('/form');
        //   }
        // },
      }
];
