import Layout from "@/Layouts/Layout";
import { Head, Link } from "@inertiajs/react";

export default function Index({ auth, posts }) {
  
    return (
        <Layout
            user={auth.user}
            header={
                <div className="flex justify-between items-center">
                  <h2 className="font-semibold text-xl text-black-800 leading-tight">
                    Posts
                  </h2>
                  <Link
                    href={route("post.create")}
                    className="bg-emerald-500 py-1 px-3 text-black rounded shadow transition-all hover:bg-emerald-600"
                  >
                    Add new
                  </Link>
                </div>
              }
            >
            <Head title="Posts" />
            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">
                <div className="bg-sky-500/100 overflow-hidden shadow-sm sm:rounded-lg">
                    <div className="p-6 text-black-900 text-black-100">
                    <h3 className="text-black-200 text-xl font-semibold">
                        Posts
                    </h3>

                    <table className="mt-3 w-full text-sm text-left rtl:text-right text-black-500 text-black-400">
                        <thead className="text-xs text-black-700 uppercase bg-sky-500/100 text-black-400 border-b-2 border-gray-500">
                        <tr>
                            <th className="px-3 py-3">ID</th>
                            <th className="px-3 py-3">Post Title</th>
                            <th className="px-3 py-3">Post Content</th>
                        </tr>
                        </thead>
                        <tbody>
                        {posts && posts.data.map((post) => (
                            <tr key={post.id}>
                            <td className="px-3 py-2">{post.id}</td>
                            <td className="px-3 py-2 text-black">
                            <Link href={route("post.show", {slug: post.slug})}>
                            {post.title}
                            </Link>
                            </td>
                            <td className="px-3 py-2 text-nowrap">{post.content}</td>
                            </tr>
                        ))}
                        </tbody>
                    </table>
                    </div>
                </div>
                </div>
            </div>
        </Layout>
    )
}