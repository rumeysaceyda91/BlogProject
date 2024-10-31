import InputError from '@/Components/InputError';
import InputLabel from '@/Components/InputLabel';
import TextInput from '@/Components/TextInput';
import TextAreaInput from "@/Components/TextAreaInput";
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';

export default function Show({auth,data}) {

    return (
        <AuthenticatedLayout
        user={auth.user}
        header={
          <div className="flex justify-between items-center">
            <h2 className="font-semibold text-xl text-gray-800 leading-tight">
              Post Detail
            </h2>
          </div>
        }
      >
            <Head title={`Post "${post.title}"`} />
            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        
                        <div className="p-6 text-black-900 text-black-100">
                            <div className="grid gap-1 grid-cols-2 mt-2">
                                <div>
                                    <label className="font-bold text-lg">Post ID</label>
                                    <p className="mt-1">{post.id}</p>
                                </div>
                                <div className="mt-4">
                                    <label className="font-bold text-lg">Post Title</label>
                                    <p className="mt-1">{post.title}</p>
                                </div>
                            </div>

                            <div className="mt-4">
                                <label className="font-bold text-lg">Post Content</label>
                                <p className="mt-1">{post.content}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
