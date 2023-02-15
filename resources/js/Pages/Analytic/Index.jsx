import React from 'react';
import Authenticated from '@/Layouts/AuthenticatedLayout';
import {Inertia} from "@inertiajs/inertia";
import {Head, usePage, Link} from '@inertiajs/react';
import Table from "@/Components/Table";




export default function DashboardAnalytic(props) {
    const {lines} = usePage().props;

    return (
        <Authenticated
            auth={props.auth}
            errors={props.errors}
            header={<h2 className="font-semibold text-xl text-gray-800 dark:text-white leading-tight">Analytic</h2>}
        >
            <Head title="Analytic"/>

            <div className="py-0">
                <div className="max-w12-xl mx-auto pb-12 sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <Table lines={lines}/>
                    </div>
                </div>
            </div>
        </Authenticated>
    );
}
