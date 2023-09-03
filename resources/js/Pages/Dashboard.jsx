import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import {Head} from '@inertiajs/react';
import MapChart from "@/Components/Map";

export default function Dashboard(props) {
    console.log(props.mapMarkers)
    return (
        <AuthenticatedLayout
            auth={props.auth}
            errors={props.errors}
            header={<h2 className="font-semibold text-grey-900 dark:text-white text-xl text-gray-800 leading-tight">Aurora</h2>}
        >
            <Head title="Dashboard"/>

            <div className="max-w-7xl mx-auto py-0 bg-gray-100 dark:bg-slate-800">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div className="p-6 text-gray-900">You're logged in!</div>
                    </div>
                </div>


                <div className="max-w-7xl mx-auto mt-5 sm:px-6 lg:px-8  ">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div
                            className="p-6 text-gray-900">{props.auth.user.email_verified_at ? 'Verified' : 'No verified'}</div>
                    </div>
                </div>

                <div className="max-w-7xl mx-auto mt-5 pb-6 sm:px-6 lg:px-8  ">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div>
                            <MapChart
                                mapMarkers={props.mapMarkers}
                            />
                        </div>
                    </div>
                </div>
            </div>

        </AuthenticatedLayout>
    );
}
