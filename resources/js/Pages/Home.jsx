import { useState } from "react";
import { Head, usePage } from "@inertiajs/react";

export default function Home() {
    const { products, categories, roomtypes } = usePage().props;

    const [selectedCategory, setSelectedCategory] = useState("");
    const [selectedRoomType, setSelectedRoomType] = useState("");

    const filteredProducts = products.filter((product) => {
        return (
            (selectedCategory === "" || product.category?.id == selectedCategory) &&
            (selectedRoomType === "" || product.roomtype?.id == selectedRoomType)
        );
    });

    return (
        <div className="container mx-auto p-4">
            <Head title="Home | Furniture Store" />

            <h1 className="text-2xl font-bold mb-4">ร้านขายเฟอร์นิเจอร์ออนไลน์</h1>

            {/* Dropdown Filters */}
            <div className="flex gap-4 mb-4">
                <select
                    className="border p-2 rounded"
                    value={selectedCategory}
                    onChange={(e) => setSelectedCategory(e.target.value)}
                >
                    <option value="">เลือกหมวดหมู่</option>
                    {categories.map((category) => (
                        <option key={category.id} value={category.id}>
                            {category.name}
                        </option>
                    ))}
                </select>

                <select
                    className="border p-2 rounded"
                    value={selectedRoomType}
                    onChange={(e) => setSelectedRoomType(e.target.value)}
                >
                    <option value="">เลือกประเภทห้อง</option>
                    {roomtypes.map((roomtype) => (
                        <option key={roomtype.id} value={roomtype.id}>
                            {roomtype.name}
                        </option>
                    ))}
                </select>
            </div>

            {/* Product List */}
            <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
                {filteredProducts.length > 0 ? (
                    filteredProducts.map((product) => (
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
                    ))
                ) : (
                    <p className="text-gray-500">ไม่พบสินค้า</p>
                )}
            </div>
        </div>
    );
}