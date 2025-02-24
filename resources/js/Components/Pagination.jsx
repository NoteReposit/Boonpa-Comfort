import { Link } from "@inertiajs/react";

export default function Pagination({ links }) {
    return (
        <div className="mt-4 flex justify-center gap-2">
            {links.map((link, index) => (
                <Link
                    key={index}
                    href={link.url || ""}
                    className={`px-3 py-1 border rounded ${
                        link.active ? "bg-blue-500 text-white" : "text-gray-700"
                    }`}
                    dangerouslySetInnerHTML={{ __html: link.label }}
                />
            ))}
        </div>
    );
}