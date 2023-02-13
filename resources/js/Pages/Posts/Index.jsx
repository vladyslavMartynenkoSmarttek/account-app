import React from 'react';
import Authenticated from '@/Layouts/AuthenticatedLayout';
import {Inertia} from "@inertiajs/inertia";
import {Head, usePage, Link} from '@inertiajs/react';
import Pencil from "@/Components/Pencil";

export default function DashboardPosts(props) {
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
            header={<h2 className="font-semibold text-xl text-gray-800 dark:text-white leading-tight">Posts</h2>}
        >
            <Head title="Posts"/>

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div className="p-6 bg-white border-b border-gray-200">

                            <div className="flex flex- items-center justify-end mb-6">
                                {/*<Link*/}
                                {/*    className="px-6 py-2 text-white bg-green-500 rounded-md focus:outline-none"*/}
                                {/*    href={route("posts.create")}*/}
                                {/*>*/}
                                {/*    Create Post*/}
                                {/*</Link>*/}
                                <a href="/posts/create"
                                   className="hover:bg-blue-400 group flex items-center rounded-md bg-blue-500 text-white text-sm font-medium pl-2 pr-3 py-2 shadow-sm">
                                    <svg width="20" height="20" fill="currentColor" className="mr-2" aria-hidden="true">
                                        <path
                                            d="M10 5a1 1 0 0 1 1 1v3h3a1 1 0 1 1 0 2h-3v3a1 1 0 1 1-2 0v-3H6a1 1 0 1 1 0-2h3V6a1 1 0 0 1 1-1Z"/>
                                    </svg>
                                    New
                                </a>
                            </div>
                            {/*
                            q:what class name table bordered in tailwind css
                            a: https://tailwindcomponents.com/component/table-with-borders

                            q:what icon class edit in tailwind css
                            a: https://heroicons.com/

                            q:what class name for stroke in react
                            a: https://heroicons.com/usage
                            */}

                            <table className="table-fixed w-full ">
                                <thead>
                                <tr className="bg-gray-100">
                                    <th className="px-4 py-2 w-20 text-left">No.</th>
                                    <th className="px-4 py-2 text-left">Title</th>
                                    <th className="px-4 py-2 text-left">Body</th>
                                    <th className="px-4 py-2 text-left">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                {posts.map(({id, title, body}) => (
                                    <tr key={id}>
                                        <td className="border px-4 py-2">{id}</td>
                                        <td className="border px-4 py-2">{title}</td>
                                        <td className="border px-4 py-2">{body}</td>
                                        <td className="border px-4 py-2">
                                            {/*need refactor to icons*/}
                                            {/*<Link*/}
                                            {/*    tabIndex="1"*/}
                                            {/*    className="px-4 py-2 text-sm text-white bg-blue-500 rounded"*/}
                                            {/*    href={route("posts.edit", id)}*/}
                                            {/*>
                                            </Link>*/}
                                            <Pencil></Pencil>
                                            <button
                                                onClick={destroy}
                                                id={id}
                                                tabIndex="-1"
                                                type="button"
                                                className="mx-1 px-4 py-2 text-sm text-white bg-red-500 rounded"
                                            >
                                                Delete
                                            </button>

                                        </td>
                                    </tr>
                                ))}

                                {posts.length === 0 && (
                                    <tr>
                                        <td
                                            className="px-6 py-4 border-t"
                                            colSpan="4"
                                        >
                                            No contacts found.
                                        </td>
                                    </tr>
                                )}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </Authenticated>
    );
}
