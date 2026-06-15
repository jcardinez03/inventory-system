
import { useState } from "react";
import {
  LineChart, Line, XAxis, YAxis, Tooltip, ResponsiveContainer,
  PieChart, Pie, Cell
} from "recharts";

const salesData = [
  { day: 1, sales: 1000 }, { day: 5, sales: 1200 }, { day: 8, sales: 900 },
  { day: 10, sales: 2100 }, { day: 12, sales: 1800 }, { day: 14, sales: 1600 },
  { day: 15, sales: 800 }, { day: 18, sales: 1400 }, { day: 20, sales: 1900 },
  { day: 22, sales: 2000 }, { day: 24, sales: 1700 }, { day: 25, sales: 3500 },
  { day: 27, sales: 2400 }, { day: 29, sales: 2200 }, { day: 30, sales: 1800 },
  { day: 31, sales: 2600 },
];

const pieData = [
  { name: "Stock In", value: 560 },
  { name: "Stock Out", value: 320 },
];

const lowStockItems = [
  { name: "Wireless Mouse", sku: "SKU: MSE-001", left: 2, color: "#ef4444", max: 10 },
  { name: "Mechanical Keyboard", sku: "SKU: KB-002", left: 1, color: "#ef4444", max: 10 },
  { name: '24" Monitor', sku: "SKU: MON-024", left: 4, color: "#f97316", max: 10 },
  { name: "Headset", sku: "SKU: HDS-001", left: 3, color: "#f97316", max: 10 },
];

const activities = [
  { type: "in", label: "Stock In", desc: "50 pcs of Wireless Mouse added", time: "2 mins ago" },
  { type: "out", label: "Stock Out", desc: "10 pcs of Mechanical Keyboard sold", time: "5 mins ago" },
  { type: "in", label: "Stock In", desc: '20 pcs of 24" Monitor added', time: "10 mins ago" },
  { type: "update", label: "Product Updated", desc: 'Laptop Pro 15" information updated', time: "15 mins ago" },
];

const navItems = [
  { icon: "🏠", label: "Dashboard", active: true },
  { icon: "📦", label: "Products" },
  { icon: "🗂️", label: "Categories" },
  { icon: "⬇️", label: "Stock In" },
  { icon: "⬆️", label: "Stock Out" },
  { icon: "🛒", label: "Sales" },
  { icon: "📊", label: "Reports" },
  { icon: "🚚", label: "Suppliers" },
  { icon: "👤", label: "Users" },
  { icon: "⚙️", label: "Settings" },
];

const statCards = [
  {
    label: "Total Products",
    value: "1,245",
    sub: "All items in inventory",
    color: "#6366f1",
    bg: "#eef2ff",
    icon: "📦",
    trend: [30, 40, 35, 50, 49, 60, 70, 65],
    trendColor: "#6366f1",
    change: null,
  },
  {
    label: "Stock In",
    value: "560",
    sub: "+12% from last month",
    color: "#22c55e",
    bg: "#f0fdf4",
    icon: "⬇️",
    trend: [20, 25, 30, 28, 35, 40, 38, 45],
    trendColor: "#22c55e",
    change: "+12%",
  },
  {
    label: "Stock Out",
    value: "320",
    sub: "-8% from last month",
    color: "#f43f5e",
    bg: "#fff1f2",
    icon: "⬆️",
    trend: [40, 35, 38, 30, 28, 25, 22, 20],
    trendColor: "#f43f5e",
    change: "-8%",
  },
  {
    label: "Sales Today",
    value: "₱12,500",
    sub: "+15% from yesterday",
    color: "#a855f7",
    bg: "#faf5ff",
    icon: "💰",
    trend: [10, 20, 18, 30, 28, 35, 40, 50],
    trendColor: "#a855f7",
    change: "+15%",
  },
];

function MiniSparkline({ data, color }) {
  const max = Math.max(...data);
  const min = Math.min(...data);
  const w = 80, h = 36;
  const pts = data.map((v, i) => {
    const x = (i / (data.length - 1)) * w;
    const y = h - ((v - min) / (max - min + 1)) * h;
    return `${x},${y}`;
  });
  return (
    <svg width={w} height={h} viewBox={`0 0 ${w} ${h}`}>
      <polyline
        fill="none"
        stroke={color}
        strokeWidth="2"
        strokeLinejoin="round"
        strokeLinecap="round"
        points={pts.join(" ")}
      />
      {data.map((v, i) => {
        const x = (i / (data.length - 1)) * w;
        const y = h - ((v - min) / (max - min + 1)) * h;
        return i === data.length - 1 ? (
          <circle key={i} cx={x} cy={y} r="3" fill={color} />
        ) : null;
      })}
    </svg>
  );
}

function ActivityIcon({ type }) {
  if (type === "in") return (
    <div style={{ width: 36, height: 36, borderRadius: 10, background: "#f0fdf4", display: "flex", alignItems: "center", justifyContent: "center", flexShrink: 0 }}>
      <span style={{ fontSize: 16 }}>⬇️</span>
    </div>
  );
  if (type === "out") return (
    <div style={{ width: 36, height: 36, borderRadius: 10, background: "#fff1f2", display: "flex", alignItems: "center", justifyContent: "center", flexShrink: 0 }}>
      <span style={{ fontSize: 16 }}>⬆️</span>
    </div>
  );
  return (
    <div style={{ width: 36, height: 36, borderRadius: 10, background: "#eff6ff", display: "flex", alignItems: "center", justifyContent: "center", flexShrink: 0 }}>
      <span style={{ fontSize: 16 }}>✏️</span>
    </div>
  );
}

const ItemIcon = ({ name }) => {
  const icons = {
    "Wireless Mouse": "🖱️",
    "Mechanical Keyboard": "⌨️",
    '24" Monitor': "🖥️",
    "Headset": "🎧",
  };
  return (
    <div style={{ width: 44, height: 44, borderRadius: 10, background: "#f3f4f6", display: "flex", alignItems: "center", justifyContent: "center", flexShrink: 0, fontSize: 22 }}>
      {icons[name] || "📦"}
    </div>
  );
};

export default function InventoryDashboard() {
  const [activeNav, setActiveNav] = useState("Dashboard");

  return (
    <div style={{ display: "flex", height: "100vh", fontFamily: "'Inter', sans-serif", background: "#f1f5f9", overflow: "hidden" }}>
      {/* Sidebar */}
      <aside style={{
        width: 220, background: "#1e293b", display: "flex", flexDirection: "column",
        padding: "24px 0", flexShrink: 0, overflowY: "auto"
      }}>
        {/* Logo */}
        <div style={{ padding: "0 20px 28px", display: "flex", alignItems: "center", gap: 10 }}>
          <div style={{ width: 36, height: 36, background: "#3b82f6", borderRadius: 10, display: "flex", alignItems: "center", justifyContent: "center", fontSize: 18 }}>📦</div>
          <div>
            <div style={{ color: "#fff", fontWeight: 700, fontSize: 15, lineHeight: 1.1 }}>Inventory</div>
            <div style={{ color: "#94a3b8", fontSize: 11 }}>Management System</div>
          </div>
        </div>

        {/* Nav */}
        <nav style={{ flex: 1, padding: "0 12px" }}>
          {navItems.map(item => (
            <button key={item.label} onClick={() => setActiveNav(item.label)}
              style={{
                width: "100%", display: "flex", alignItems: "center", gap: 10,
                padding: "10px 12px", borderRadius: 10, border: "none", cursor: "pointer",
                background: activeNav === item.label ? "#3b82f6" : "transparent",
                color: activeNav === item.label ? "#fff" : "#94a3b8",
                fontWeight: activeNav === item.label ? 600 : 400,
                fontSize: 14, marginBottom: 2, transition: "all 0.15s", textAlign: "left",
              }}>
              <span style={{ fontSize: 16, width: 20, textAlign: "center" }}>{item.icon}</span>
              {item.label}
            </button>
          ))}
        </nav>

        {/* Help card */}
        <div style={{ margin: "16px 12px 0", background: "linear-gradient(135deg,#3b82f6,#6366f1)", borderRadius: 12, padding: "16px 14px" }}>
          <div style={{ color: "#fff", fontWeight: 600, fontSize: 13, marginBottom: 4 }}>Need help managing your inventory?</div>
          <a href="#" style={{ color: "#bfdbfe", fontSize: 12, textDecoration: "none" }}>Check our docs ↗</a>
        </div>
      </aside>

      {/* Main */}
      <div style={{ flex: 1, display: "flex", flexDirection: "column", overflow: "hidden" }}>
        {/* Top bar */}
        <header style={{
          background: "#fff", padding: "0 28px", height: 60, display: "flex",
          alignItems: "center", justifyContent: "space-between",
          borderBottom: "1px solid #e2e8f0", flexShrink: 0,
        }}>
          <div style={{ display: "flex", alignItems: "center", gap: 12 }}>
            <button style={{ background: "none", border: "none", cursor: "pointer", fontSize: 20, color: "#64748b" }}>☰</button>
            <span style={{ fontWeight: 600, fontSize: 16, color: "#1e293b" }}>Dashboard</span>
          </div>
          <div style={{ display: "flex", alignItems: "center", gap: 16 }}>
            <div style={{ position: "relative" }}>
              <button style={{ background: "none", border: "none", cursor: "pointer", fontSize: 20, color: "#64748b" }}>🔔</button>
              <span style={{ position: "absolute", top: -2, right: -2, width: 16, height: 16, background: "#ef4444", borderRadius: "50%", fontSize: 10, color: "#fff", display: "flex", alignItems: "center", justifyContent: "center", fontWeight: 700 }}>3</span>
            </div>
            <div style={{ display: "flex", alignItems: "center", gap: 8 }}>
              <div style={{ width: 32, height: 32, borderRadius: "50%", background: "#e2e8f0", display: "flex", alignItems: "center", justifyContent: "center", fontSize: 18 }}>👤</div>
              <span style={{ fontWeight: 500, fontSize: 14, color: "#1e293b" }}>Admin ▾</span>
            </div>
          </div>
        </header>

        {/* Content */}
        <main style={{ flex: 1, overflowY: "auto", padding: "24px 28px" }}>
          {/* Welcome row */}
          <div style={{ display: "flex", justifyContent: "space-between", alignItems: "flex-start", marginBottom: 20 }}>
            <div>
              <h1 style={{ margin: 0, fontSize: 22, fontWeight: 700, color: "#1e293b" }}>Welcome back, Admin! 👋</h1>
              <p style={{ margin: "4px 0 0", fontSize: 13, color: "#64748b" }}>Here's what's happening with your inventory today.</p>
            </div>
            <button style={{
              display: "flex", alignItems: "center", gap: 8, padding: "8px 14px",
              background: "#fff", border: "1px solid #e2e8f0", borderRadius: 8,
              fontSize: 13, color: "#475569", cursor: "pointer", fontWeight: 500,
            }}>
              📅 May 18, 2025 ▾
            </button>
          </div>

          {/* Stat cards */}
          <div style={{ display: "grid", gridTemplateColumns: "repeat(4, 1fr)", gap: 16, marginBottom: 20 }}>
            {statCards.map(card => (
              <div key={card.label} style={{ background: "#fff", borderRadius: 14, padding: "18px 20px", boxShadow: "0 1px 3px rgba(0,0,0,0.06)" }}>
                <div style={{ display: "flex", justifyContent: "space-between", alignItems: "flex-start" }}>
                  <div>
                    <div style={{ fontSize: 12, color: "#64748b", marginBottom: 4 }}>{card.label}</div>
                    <div style={{ fontSize: 26, fontWeight: 700, color: "#1e293b" }}>{card.value}</div>
                  </div>
                  <div style={{ width: 40, height: 40, background: card.bg, borderRadius: 10, display: "flex", alignItems: "center", justifyContent: "center", fontSize: 18 }}>
                    {card.icon}
                  </div>
                </div>
                <div style={{ display: "flex", justifyContent: "space-between", alignItems: "flex-end", marginTop: 10 }}>
                  <div style={{ fontSize: 11, color: card.change?.startsWith("-") ? "#ef4444" : "#22c55e" }}>{card.sub}</div>
                  <MiniSparkline data={card.trend} color={card.trendColor} />
                </div>
              </div>
            ))}
          </div>

          {/* Middle row */}
          <div style={{ display: "grid", gridTemplateColumns: "1fr 1fr", gap: 16, marginBottom: 20 }}>
            {/* Inventory Movement */}
            <div style={{ background: "#fff", borderRadius: 14, padding: "20px 24px", boxShadow: "0 1px 3px rgba(0,0,0,0.06)" }}>
              <div style={{ display: "flex", justifyContent: "space-between", alignItems: "center", marginBottom: 16 }}>
                <span style={{ fontWeight: 600, fontSize: 15, color: "#1e293b" }}>Inventory Movement (In vs Out)</span>
                <span style={{ color: "#94a3b8", cursor: "pointer" }}>⋮</span>
              </div>
              <div style={{ display: "flex", alignItems: "center", gap: 24 }}>
                <div style={{ position: "relative" }}>
                  <PieChart width={160} height={160}>
                    <Pie data={pieData} cx={75} cy={75} innerRadius={52} outerRadius={72} dataKey="value" startAngle={90} endAngle={-270} strokeWidth={0}>
                      <Cell fill="#22c55e" />
                      <Cell fill="#f43f5e" />
                    </Pie>
                  </PieChart>
                  <div style={{ position: "absolute", top: "50%", left: "50%", transform: "translate(-50%,-50%)", textAlign: "center" }}>
                    <div style={{ fontWeight: 700, fontSize: 20, color: "#1e293b" }}>880</div>
                    <div style={{ fontSize: 10, color: "#64748b" }}>Total Movement</div>
                  </div>
                </div>
                <div style={{ flex: 1 }}>
                  <div style={{ marginBottom: 16 }}>
                    <div style={{ fontSize: 22, fontWeight: 700, color: "#22c55e" }}>64%</div>
                    <div style={{ fontSize: 12, color: "#64748b" }}>Stock In</div>
                  </div>
                  <div style={{ marginBottom: 16 }}>
                    <div style={{ display: "flex", alignItems: "center", gap: 6, marginBottom: 2 }}>
                      <div style={{ width: 10, height: 10, borderRadius: "50%", background: "#22c55e" }} />
                      <span style={{ fontSize: 12, color: "#475569" }}>Stock In</span>
                    </div>
                    <div style={{ fontWeight: 600, fontSize: 13, color: "#1e293b" }}>560 (64%)</div>
                  </div>
                  <div>
                    <div style={{ fontSize: 22, fontWeight: 700, color: "#f43f5e" }}>36%</div>
                    <div style={{ fontSize: 12, color: "#64748b" }}>Stock Out</div>
                  </div>
                  <div style={{ marginTop: 8 }}>
                    <div style={{ display: "flex", alignItems: "center", gap: 6, marginBottom: 2 }}>
                      <div style={{ width: 10, height: 10, borderRadius: "50%", background: "#f43f5e" }} />
                      <span style={{ fontSize: 12, color: "#475569" }}>Stock Out</span>
                    </div>
                    <div style={{ fontWeight: 600, fontSize: 13, color: "#1e293b" }}>320 (36%)</div>
                  </div>
                </div>
              </div>
              <div style={{ fontSize: 11, color: "#94a3b8", marginTop: 8 }}>Total movement this month</div>
            </div>

            {/* Low Stock Alerts */}
            <div style={{ background: "#fff", borderRadius: 14, padding: "20px 24px", boxShadow: "0 1px 3px rgba(0,0,0,0.06)" }}>
              <div style={{ display: "flex", justifyContent: "space-between", alignItems: "center", marginBottom: 16 }}>
                <span style={{ fontWeight: 600, fontSize: 15, color: "#1e293b" }}>Low Stock Alerts</span>
                <a href="#" style={{ fontSize: 12, color: "#3b82f6", textDecoration: "none", fontWeight: 500 }}>View all</a>
              </div>
              <div style={{ display: "flex", flexDirection: "column", gap: 14 }}>
                {lowStockItems.map(item => (
                  <div key={item.name} style={{ display: "flex", alignItems: "center", gap: 12 }}>
                    <ItemIcon name={item.name} />
                    <div style={{ flex: 1 }}>
                      <div style={{ fontWeight: 600, fontSize: 13, color: "#1e293b" }}>{item.name}</div>
                      <div style={{ fontSize: 11, color: "#94a3b8" }}>{item.sku}</div>
                      <div style={{ marginTop: 4, height: 4, background: "#f1f5f9", borderRadius: 4, overflow: "hidden" }}>
                        <div style={{ height: "100%", width: `${(item.left / item.max) * 100}%`, background: item.color, borderRadius: 4 }} />
                      </div>
                    </div>
                    <div style={{ fontSize: 12, fontWeight: 600, color: item.color, whiteSpace: "nowrap" }}>
                      {item.left} {item.left === 1 ? "pc" : "pcs"} left
                    </div>
                    <span style={{ color: "#cbd5e1", fontSize: 16 }}>›</span>
                  </div>
                ))}
              </div>
            </div>
          </div>

          {/* Bottom row */}
          <div style={{ display: "grid", gridTemplateColumns: "1fr 1fr", gap: 16 }}>
            {/* Average Sales Chart */}
            <div style={{ background: "#fff", borderRadius: 14, padding: "20px 24px", boxShadow: "0 1px 3px rgba(0,0,0,0.06)" }}>
              <div style={{ display: "flex", justifyContent: "space-between", alignItems: "center", marginBottom: 16 }}>
                <span style={{ fontWeight: 600, fontSize: 15, color: "#1e293b" }}>Average Sales – This Month</span>
                <button style={{ fontSize: 12, padding: "4px 10px", border: "1px solid #e2e8f0", borderRadius: 6, background: "#fff", color: "#475569", cursor: "pointer" }}>This Month ▾</button>
              </div>
              <ResponsiveContainer width="100%" height={180}>
                <LineChart data={salesData} margin={{ top: 4, right: 4, left: -20, bottom: 0 }}>
                  <defs>
                    <linearGradient id="salesFill" x1="0" y1="0" x2="0" y2="1">
                      <stop offset="5%" stopColor="#3b82f6" stopOpacity={0.15} />
                      <stop offset="95%" stopColor="#3b82f6" stopOpacity={0} />
                    </linearGradient>
                  </defs>
                  <XAxis dataKey="day" tick={{ fontSize: 10, fill: "#94a3b8" }} axisLine={false} tickLine={false} />
                  <YAxis tickFormatter={v => `₱${(v / 1000).toFixed(0)}K`} tick={{ fontSize: 10, fill: "#94a3b8" }} axisLine={false} tickLine={false} />
                  <Tooltip formatter={v => [`₱${v.toLocaleString()}`, "Sales"]} labelFormatter={l => `Day ${l}`} contentStyle={{ borderRadius: 8, border: "none", boxShadow: "0 2px 8px rgba(0,0,0,0.1)", fontSize: 12 }} />
                  <Line type="monotone" dataKey="sales" stroke="#3b82f6" strokeWidth={2} dot={{ r: 3, fill: "#3b82f6", strokeWidth: 0 }} activeDot={{ r: 5 }} />
                </LineChart>
              </ResponsiveContainer>
              <div style={{ textAlign: "center", fontSize: 11, color: "#64748b", marginTop: 6 }}>
                <span style={{ display: "inline-flex", alignItems: "center", gap: 4 }}>
                  <span style={{ display: "inline-block", width: 20, height: 2, background: "#3b82f6", borderRadius: 2 }} />
                  Average Sales (PHP)
                </span>
              </div>
            </div>

            {/* Recent Activities */}
            <div style={{ background: "#fff", borderRadius: 14, padding: "20px 24px", boxShadow: "0 1px 3px rgba(0,0,0,0.06)" }}>
              <div style={{ display: "flex", justifyContent: "space-between", alignItems: "center", marginBottom: 16 }}>
                <span style={{ fontWeight: 600, fontSize: 15, color: "#1e293b" }}>Recent Activities</span>
                <a href="#" style={{ fontSize: 12, color: "#3b82f6", textDecoration: "none", fontWeight: 500 }}>View all</a>
              </div>
              <div style={{ display: "flex", flexDirection: "column", gap: 16 }}>
                {activities.map((a, i) => (
                  <div key={i} style={{ display: "flex", alignItems: "center", gap: 12 }}>
                    <ActivityIcon type={a.type} />
                    <div style={{ flex: 1 }}>
                      <div style={{ fontWeight: 600, fontSize: 13, color: "#1e293b" }}>{a.label}</div>
                      <div style={{ fontSize: 12, color: "#64748b" }}>{a.desc}</div>
                    </div>
                    <div style={{ fontSize: 11, color: "#94a3b8", whiteSpace: "nowrap" }}>{a.time}</div>
                  </div>
                ))}
              </div>
            </div>
          </div>
        </main>
      </div>
    </div>
  );
}