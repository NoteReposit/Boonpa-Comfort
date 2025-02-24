import { Head, Link, usePage } from "@inertiajs/react";

export default function Show() {
    const { order } = usePage().props;

    if (!order || !order.orderDetails) {
        return <p className="text-gray-500">Loading...</p>;
    }

    return (
        <div className="container mx-auto p-4">
            <Head title={`Order #${order.id}`} />

            <h1 className="text-2xl font-bold mb-4">Order #{order.id}</h1>
            <p className="text-sm text-gray-500">Date: {order.order_date}</p>
            <p className="text-sm text-gray-500">Total: ฿{order.total_price}</p>
            <p className="text-sm text-gray-500">Status: {order.status}</p>

            <h2 className="text-xl font-semibold mt-4">Order Details</h2>
            <div className="grid grid-cols-1 md:grid-cols-2 gap-4 mt-2">
                {order.orderDetails.map((detail) => (
                    <div key={detail.id} className="border p-4 rounded-lg shadow">
                        <h3 className="text-lg font-semibold">{detail.product?.name || "Unknown Product"}</h3>
                        <p className="text-sm text-gray-500">Quantity: {detail.quantity}</p>
                        <p className="text-sm text-gray-500">Price per unit: ฿{detail.price_per_unit}</p>
                        <p className="text-sm text-gray-500">Subtotal: ฿{detail.subtotal}</p>
                    </div>
                ))}
            </div>

            <Link href={route("orders.index")} className="text-blue-500 mt-4 inline-block">
                กลับไปหน้าคำสั่งซื้อ
            </Link>
        </div>
    );
}
