import { Link, usePage, router } from "@inertiajs/react";

export default function Index() {
    const { categories } = usePage().props;

    const deleteCategory = (id) => {
        if (confirm("Are you sure you want to delete this category?")) {
            router.delete(`/categories/${id}`);
        }
    };

    return (
        <div className="bg-gray-100 min-h-screen">
            {/* Navbar */}
            <nav className="bg-blue-600 p-4 shadow-lg sticky top-0 z-50">
                <div className="container mx-auto flex items-center justify-between">
                    <Link href="/" className="text-white text-2xl font-semibold">
                        🏠 Home
                    </Link>
                    <div className="space-x-6">
                        <Link href="/categories" className="text-white hover:text-gray-200 transition">
                            Categories
                        </Link>
                        <Link href="/roomtypes" className="text-white hover:text-gray-200 transition">
                            Room Types
                        </Link>
                    </div>
                </div>
            </nav>

            {/* Main Content */}
            <div className="container mx-auto mt-12 px-6">
                <div className="bg-white p-8 rounded-lg shadow-lg">
                    <h1 className="text-3xl font-bold text-gray-800 mb-6">📂 Category List</h1>

                    <div className="flex justify-end mb-6">
                        <Link
                            href="/categories/create"
                            className="bg-blue-600 text-white px-6 py-3 rounded-lg shadow hover:bg-blue-700 transition"
                        >
                            ➕ Add Category
                        </Link>
                    </div>

                    <div className="overflow-x-auto">
                        <table className="min-w-full bg-white border border-gray-200 rounded-lg shadow-sm">
                            <thead>
                                <tr className="bg-gray-100">
                                    <th className="py-3 px-6 text-left text-gray-700 font-semibold">Category Name</th>
                                    <th className="py-3 px-6 text-left text-gray-700 font-semibold">Description</th>
                                    <th className="py-3 px-6 text-center text-gray-700 font-semibold">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                {categories.length > 0 ? (
                                    categories.map((category) => (
                                        <tr key={category.id} className="border-b hover:bg-gray-50 transition">
                                            <td className="py-3 px-6 text-gray-800">{category.name}</td>
                                            <td className="py-3 px-6 text-gray-600">{category.description || "No description"}</td>
                                            <td className="py-3 px-6 flex justify-center gap-4">
                                                <Link
                                                    href={`/categories/${category.id}/edit`}
                                                    className="text-yellow-600 hover:text-yellow-800 transition"
                                                >
                                                    ✏️ Edit
                                                </Link>
                                                <button
                                                    onClick={() => deleteCategory(category.id)}
                                                    className="text-red-600 hover:text-red-800 transition"
                                                >
                                                    🗑️ Delete
                                                </button>
                                            </td>
                                        </tr>
                                    ))
                                ) : (
                                    <tr>
                                        <td colSpan="3" className="text-center py-4 text-gray-500">
                                            No categories found.
                                        </td>
                                    </tr>
                                )}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    );
}