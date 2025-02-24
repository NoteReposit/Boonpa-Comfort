import { Head, Link, useForm } from '@inertiajs/react';

export default function Show({ product }) {
    const { data, setData, post, processing } = useForm({
        product_id: product.id,
        quantity: 1,
    });

    const handleAddToCart = (e) => {
        e.preventDefault();
        post(route('cart.store'));
    };

    return (
        <div className="container mx-auto p-4">
            <Head title={product.name} />

            <h1 className="text-2xl font-bold mb-4">{product.name}</h1>
            <img src={product.image_url} alt={product.name} className="w-full h-60 object-cover rounded" />
            <p className="text-lg mt-4">{product.description}</p>
            <p className="text-md font-bold mt-2">฿{product.price}</p>
            <p className="text-sm text-gray-600">
                หมวดหมู่: {product.category?.name} | ห้อง: {product.roomtype?.name}
            </p>
            <p className="text-sm mt-1">คงเหลือ: {product.stock_quantity} ชิ้น</p>

            <form onSubmit={handleAddToCart} className="mt-4">
                <input
                    type="number"
                    min="1"
                    value={data.quantity}
                    onChange={(e) => setData('quantity', e.target.value)}
                    className="border p-2 rounded mr-2"
                />
                <button
                    type="submit"
                    className="bg-blue-500 text-white px-4 py-2 rounded"
                    disabled={processing}
                >
                    Add to Cart
                </button>
            </form>

            <Link href={route('home')} className="text-blue-500 mt-4 inline-block">กลับไปหน้าหลัก</Link>
        </div>
    );
}