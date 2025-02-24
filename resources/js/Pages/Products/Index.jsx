import { useState } from "react";
import { Head, usePage } from "@inertiajs/react";

export default function ProductIndex() {
    const { products } = usePage().props;

    return (
        <div className="container mx-auto p-4">
            <Head title="Product List" />

            <h1 className="text-2xl font-bold mb-4">รายการสินค้า</h1>

            <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
                {products.map((product) => (
                    <div key={product.id} className="border p-4 rounded-lg shadow">
                        <img
                            src={product.image_url}
                            alt={product.name}
                            className="w-full h-40 object-cover rounded"
                        />
                        <h2 className="text-lg font-semibold mt-2">{product.name}</h2>
                        <p className="text-sm text-gray-500">{product.description}</p>
                        <p className="text-md font-bold mt-1">฿{product.price}</p>
                        <p className="text-xs text-gray-600">
                            หมวดหมู่: {product.category?.name} | ห้อง: {product.roomtype?.name}
                        </p>
                        <p className="text-sm mt-1">คงเหลือ: {product.stock_quantity} ชิ้น</p>
                    </div>
                ))}
            </div>
        </div>
    );
}
