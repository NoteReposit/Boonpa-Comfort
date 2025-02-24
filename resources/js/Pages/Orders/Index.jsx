import { Head, Link, usePage } from "@inertiajs/react";
import Pagination from "@/Components/Pagination";

export default function Index() {
    const { orders } = usePage().props;

    return (
        <div className="container mx-auto p-4">
            <Head title="Orders" />

            <h1 className="text-2xl font-bold mb-4">คำสั่งซื้อของคุณ</h1>

            {orders.data.length > 0 ? (
                <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                    {orders.data.map((order) => (
                        <Link key={order.id} href={route("orders.show", order.id)} className="border p-4 rounded-lg shadow">
                            <h2 className="text-lg font-semibold">Order #{order.id}</h2>
                            <p className="text-sm text-gray-500">Date: {order.order_date}</p>
                            <p className="text-sm text-gray-500">Total: ฿{order.total_price}</p>
                            <p className="text-sm text-gray-500">Status: {order.status}</p>
                        </Link>
                    ))}
                </div>
            ) : (
                <p className="text-gray-500">คุณยังไม่มีคำสั่งซื้อ</p>
            )}

            <Pagination links={orders.links} />
        </div>
    );
}
