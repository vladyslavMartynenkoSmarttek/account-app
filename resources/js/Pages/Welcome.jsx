import { Link, Head } from '@inertiajs/react';

export default function Welcome(props) {
    return (
        <>
            <Head title="Welcome" />
            <div className="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0 bg-white dark:bg-slate-800">
                <div className="fixed top-0 right-0 px-6 py-4 sm:block bg-grey-100 dark:bg-slate-800">
                    {props.auth.user ? (
                        <Link href={route('dashboard')} className="text-sm text-gray-700 dark:text-gray-500 underline">
                            Dashboard
                        </Link>
                    ) : (
                        <>
                            <Link href={route('login')} className="text-sm text-gray-700 dark:text-gray-500 underline">
                                Log in
                            </Link>
                        </>
                    )}
                </div>

                <div className="max-w-6xl mx-auto sm:px-6 px-2 lg:px-8 bg-grey-100 dark:bg-slate-800">
                    <div className="flex justify-center pt-8 sm:justify-start sm:pt-0">
                        <div className="text-center sm:text-left">
                            <h1 className="text-4xl text-gray-800 dark:text-gray-200">Welcome to Aurora</h1>
                        </div>
                    </div>
                </div>
            </div>
        </>
    );
}
