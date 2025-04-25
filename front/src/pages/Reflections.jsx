import { useEffect, useState } from 'react';
import api from '../api/axios';

export default function Reflections() {
  const [reflections, setReflections] = useState([]);
  const [editingId, setEditingId] = useState(null);
  const [editData, setEditData] = useState({ quote: '', response: '' });
  const [newReflection, setNewReflection] = useState({ quote: '', response: '' });

  useEffect(() => {
    fetchReflections();
  }, []);

  const fetchReflections = () => {
    api.get('/reflections')
      .then((res) => setReflections(res.data))
      .catch((err) => console.error('一覧取得失敗', err));
  };

  const handleCreate = async () => {
    try {
      const res = await api.post('/reflections', newReflection);
      setReflections((prev) => [res.data, ...prev]);
      setNewReflection({ quote: '', response: '' });
    } catch (err) {
      console.error('作成失敗', err);
    }
  };

  const handleDelete = async (id) => {
    if (!window.confirm('本当に削除しますか？')) return;
    try {
      await api.delete(`/reflections/${id}`);
      setReflections((prev) => prev.filter((r) => r.id !== id));
    } catch (err) {
      console.error('削除失敗', err);
    }
  };

  const handleEditClick = (reflection) => {
    setEditingId(reflection.id);
    setEditData({ quote: reflection.quote, response: reflection.response });
  };

  const handleEditChange = (key, value) => {
    setEditData((prev) => ({ ...prev, [key]: value }));
  };

  const handleSave = async (id) => {
    try {
      const res = await api.put(`/reflections/${id}`, editData);
      setReflections((prev) => prev.map((r) => (r.id === id ? res.data : r)));
      setEditingId(null);
    } catch (err) {
      console.error('更新失敗', err);
    }
  };

  const handleCancel = () => {
    setEditingId(null);
  };

  return (
    <div className="container py-5">
      <h2 className="mb-4">Reflections</h2>

      {/* 新規作成フォーム */}
      <div className="card mb-4">
        <div className="card-body">
          <input
            className="form-control mb-2"
            value={newReflection.quote}
            onChange={(e) => setNewReflection((prev) => ({ ...prev, quote: e.target.value }))}
            placeholder="新しい quote"
          />
          <textarea
            className="form-control mb-2"
            value={newReflection.response}
            onChange={(e) => setNewReflection((prev) => ({ ...prev, response: e.target.value }))}
            placeholder="新しい response"
          />
          <button onClick={handleCreate} className="btn btn-primary">
            追加
          </button>
        </div>
      </div>

      {/* 一覧表示 */}
      <div className="d-grid gap-3">
        {reflections.map((r) => (
          <div key={r.id} className="card">
            <div className="card-body">
              {editingId === r.id ? (
                <>
                  <input
                    className="form-control mb-2"
                    value={editData.quote}
                    onChange={(e) => handleEditChange('quote', e.target.value)}
                  />
                  <textarea
                    className="form-control mb-2"
                    value={editData.response}
                    onChange={(e) => handleEditChange('response', e.target.value)}
                  />
                  <div className="d-flex gap-2">
                    <button onClick={() => handleSave(r.id)} className="btn btn-success">
                      保存
                    </button>
                    <button onClick={handleCancel} className="btn btn-secondary">
                      キャンセル
                    </button>
                  </div>
                </>
              ) : (
                <>
                  <h5 className="card-title">{r.quote}</h5>
                  <p className="card-text">{r.response}</p>
                  <div className="d-flex gap-2">
                    <button onClick={() => handleEditClick(r)} className="btn btn-warning text-white">
                      編集
                    </button>
                    <button onClick={() => handleDelete(r.id)} className="btn btn-danger">
                      削除
                    </button>
                  </div>
                </>
              )}
            </div>
          </div>
        ))}
      </div>
    </div>
  );
}
