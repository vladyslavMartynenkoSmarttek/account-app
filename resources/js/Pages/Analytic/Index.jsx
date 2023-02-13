import React from 'react';
import Authenticated from '@/Layouts/AuthenticatedLayout';
import {Inertia} from "@inertiajs/inertia";
import {Head, usePage, Link} from '@inertiajs/react';

export default function DashboardAnalytic(props) {
    const {posts} = usePage().props;

    function destroy(e) {
        if (confirm("Are you sure you want to delete this user?")) {
            Inertia.delete(route("posts.destroy", e.currentTarget.id));
        }
    }

    return (
        <Authenticated
            auth={props.auth}
            errors={props.errors}
            header={<h2 className="font-semibold text-xl text-gray-800 dark:text-white leading-tight">Analytic</h2>}
        >
            <Head title="Posts"/>

            <div className="py-0">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        Dashboard analytic
                    </div>
                </div>
            </div>
        </Authenticated>
    );
}
