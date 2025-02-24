import { Head, Link, usePage, useForm } from '@inertiajs/react';

export default function Index() {
    const { cartItems } = usePage().props;
    const { post, processing } = useForm();

    const handlePlaceOrder = (e) => {
        e.preventDefault();
        post(route('cart.placeOrder'));
    };

    return (
        <div className="container mx-auto p-4">
            <Head title="Cart" />

            <h1 className="text-2xl font-bold mb-4">ตะกร้าสินค้าของคุณ</h1>

            {cartItems.length > 0 ? (
                <>
                    <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                        {cartItems.map((item) => (
                            <div key={item.id} className="border p-4 rounded-lg shadow">
                                <h2 className="text-lg font-semibold">{item.product.name}</h2>
                                <img src={item.product.image_url} alt={item.product.name} className="w-full h-40 object-cover rounded" />
                                <p className="text-sm text-gray-500">Quantity: {item.quantity}</p>
                                <p className="text-sm text-gray-500">Price per unit: ฿{item.product.price}</p>
                                <p className="text-sm text-gray-500">Subtotal: ฿{item.quantity * item.product.price}</p>
                            </div>
                        ))}
                    </div>
                    <form onSubmit={handlePlaceOrder} className="mt-4">
                        <button
                            type="submit"
                            className="bg-green-500 text-white px-4 py-2 rounded"
                            disabled={processing}
                        >
                            สั่งซื้อสินค้า
                        </button>
                    </form>
                </>
            ) : (
                <p className="text-gray-500">ตะกร้าสินค้าของคุณว่างเปล่า</p>
            )}

            <Link href={route('home')} className="text-blue-500 mt-4 inline-block">กลับไปหน้าหลัก</Link>
        </div>
    );
}