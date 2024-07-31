import AdminLayout from "@/Layouts/AdminLayout";
import { Head } from "@inertiajs/react";

export default function MyBookings({ auth, bookings }) {
    const { data } = bookings;

    return (
        <AdminLayout user={auth.user}>
            <Head title="My Bookings" />

            <div className="py-12">
                <div className="max-w-5xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div className="overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div className="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                                <div className="overflow-hidden">
                                    <table className="min-w-full">
                                        <thead className="bg-primary border-b dark:border-neutral-600 dark:bg-tertiary">
                                            <tr>
                                                <th
                                                    scope="col"
                                                    className="text-left py-3 px-3"
                                                >
                                                    Name
                                                </th>
                                                <th
                                                    scope="col"
                                                    className="text-left py-3 px-3"
                                                >
                                                    Title
                                                </th>
                                                <th
                                                    scope="col"
                                                    className="text-left py-3 px-3"
                                                >
                                                    Email
                                                </th>
                                                <th
                                                    scope="col"
                                                    className="text-left py-3 px-3"
                                                >
                                                    Date
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {data.map((ele, i) => (
                                                <tr
                                                    key={i + 1}
                                                    className="border-b-[2px] border-t-[2px] transition duration-300 ease-in-out cursor-pointer hover:bg-light-ash border-light-ash"
                                                >
                                                    <td className="px-3 py-2 whitespace-nowrap text-sm font-medium">
                                                        {ele.name}
                                                    </td>
                                                    <td className="px-3 py-2 whitespace-nowrap text-sm font-medium">
                                                        {ele.title}
                                                    </td>
                                                    <td className="px-3 py-2 whitespace-nowrap text-sm font-medium">
                                                        {ele.email}
                                                    </td>
                                                    <td className="px-3 py-2 whitespace-nowrap text-sm font-medium">
                                                        {ele.date}
                                                    </td>
                                                </tr>
                                            ))}
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </AdminLayout>
    );
}
